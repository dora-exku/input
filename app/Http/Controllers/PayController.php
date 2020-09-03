<?php

namespace App\Http\Controllers;

use App\Models\Input;
use Illuminate\Http\Request;
use Pay;

class PayController extends Controller
{
    public function view(Request $request, $order)
    {
        $info = Input::query()->where('no', $order)->first();
        $result = Pay::wechat()->mp([
            'out_trade_no' => $order,
            'body' => '学生意外险',
            'total_fee' => $info->total_amount,
            'openid' => $request->session()->get('openid')['openid'],
        ]);
        var_dump($result);
    }

    public function notify()
    {

    }
}
