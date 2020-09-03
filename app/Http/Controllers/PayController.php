<?php

namespace App\Http\Controllers;

use App\Models\Input;
use App\Services\WechatService;
use Illuminate\Http\Request;
use Pay;

class PayController extends Controller
{
    public function view(Request $request, $order)
    {
        $wechatService = new WechatService();
        $info = Input::query()->where('no', $order)->first();
//        $result = Pay::wechat()->mp([
//            'out_trade_no' => $order,
//            'body' => '学生意外险',
//            'total_fee' => $info->total_amount * 100,
//            'openid' => $request->session()->get('openid')['openid'],
//        ]);
        return view('pay.view', [
            'info' => $result ?? [],
            'order' => $info,
            'config' => $wechatService->getJssdkConfig()
        ]);
    }

    public function notify()
    {

    }

}
