<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;

class Input extends Model
{
    use DefaultDatetimeFormat;
    protected $fillable = ['no', 'input_ip', 'fullname', 'id_card', 'phone', 'remark', 'payment_method', 'total_amount'];

    const PAYMENT_METHOD_CASH = 'cash';

    const PAYMENT_METHOD_WECHAT = 'wechat';

    const PAYMENT_METHOD_ALIPAY = 'alipay';

    const PAYMENT_METHOD = [
        self::PAYMENT_METHOD_CASH => '现金',
        self::PAYMENT_METHOD_WECHAT => '微信',
        self::PAYMENT_METHOD_ALIPAY => '支付宝'
    ];
}
