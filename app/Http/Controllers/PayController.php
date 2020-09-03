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
        Pay::wechat()->mp([
            'out_trade_no' => time(),
            'body' => 'subject-测试',
            'total_fee'      => '1',
            'openid' => 'onkVf1FjWS5SBIixxxxxxxxx',
        ]);
    }

    public function notify()
    {

    }
}
