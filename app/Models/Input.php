<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;

class Input extends Model
{
    use DefaultDatetimeFormat;
    protected $fillable = ['no', 'input_ip', 'fullname', 'id_card', 'phone', 'remark', 'payment_method', 'total_amount', 'class_number_parnet', 'class_number_child'];

    const PAYMENT_METHOD_CASH = 'cash';

    const PAYMENT_METHOD_WECHAT = 'wechat';

    const PAYMENT_METHOD_ALIPAY = 'alipay';

    const PAYMENT_METHOD = [
        self::PAYMENT_METHOD_CASH => '现金',
        self::PAYMENT_METHOD_WECHAT => '微信',
        self::PAYMENT_METHOD_ALIPAY => '支付宝'
    ];

    const CLASS_NUMBER_PARENT = [
        1 => '初一',
        2 => '初二',
        3 => '初三',
        4 => '高一',
        5 => '高二',
        6 => '高三'
    ];

    const CLASS_NUMBER_CHILD = [
        1 => '一班',
        2 => '二班',
        3 => '三班',
        4 => '四班',
        5 => '五班',
        6 => '六班',
        7 => '七班',
        8 => '八班',
        9 => '九班',
        10 => '十班',
        11 => '十一班',
        12 => '十二班',
        13 => '十三班',
        14 => '十四班',
        15 => '十五班',
        16 => '十六班',
        17 => '十七班',
        18 => '十八班',
        19 => '十九班',
        20 => '二十班',
        21 => '二十一班',
        22 => '二十二班',
        23 => '二十三班',
        24 => '二十四班',
        25 => '二十五班',
        26 => '二十六班',
        27 => '二十七班',
        28 => '二十八班',
        29 => '二十九班',
        30 => '三十班',
    ];
}
