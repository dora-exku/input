<?php

namespace App\Http\Controllers;

use App\Models\Input;
use App\Services\WechatService;
use Illuminate\Http\Request;
use Pay;
use Yansongda\Pay\Log;

class PayController extends Controller
{
    public function view(Request $request, $order)
    {
        $wechatService = new WechatService();
        $info = Input::query()->where('no', $order)->first();
        Pay::wechat()->close([
            'out_trade_no' => $order
        ]);
        $result = Pay::wechat()->mp([
            'out_trade_no' => $order,
            'body' => '学生意外险',
//            'total_fee' => $info->total_amount * 100,
            'total_fee' => 1,
            'openid' => $request->session()->get('openid')['openid'],
        ]);
        return view('pay.view', [
            'info' => $result ?? [],
            'order' => $info,
            'config' => $wechatService->getJssdkConfig()
        ]);
    }

    public function notify()
    {
        $pay = Pay::wechat();
        try {
            $data = $pay->verify(); // 是的，验签就这么简单！
            $no = $data->out_trade_no;
            $paymentNo = $data['transaction_id'];
            $at = date('Y-m-d H:i:s');
            Input::query()->where('no', $no)->update([
                'payment_no' => $paymentNo,
                'paid_at' => $at
            ]);
            Log::info('Wechat notify', $data->all());
        } catch (\Exception $e) {
            Log::info('微信支付回调错误' . $e->getMessage());
        }
        return $pay->success();
    }

}
