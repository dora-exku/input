<?php

namespace App\Http\Controllers;

use App\Models\Input;
use Illuminate\Http\Request;
use Yansongda\Pay\Pay;

class PayController extends Controller
{
    public function view(Request $request)
    {
        $order = $request->get('order');
        $info = Input::query()->where('no', $order)->first();
        $result = Pay::wechat()->mp([
            'out_trade_no' => $order,
            'body' => '学生意外险',
            'total_fee' => $order->total_amount,
            'openid' => cookie('oi')->getValue(),
        ]);
        var_dump($result);
    }

    public function notify()
    {

    }
}
