<?php
namespace App\Admin\Extensions;

use App\Models\Input;
use Encore\Admin\Grid\Exporters\ExcelExporter;
use Maatwebsite\Excel\Concerns\WithMapping;

class InputsExporter extends ExcelExporter implements WithMapping
{
    protected $fileName = '数据列表.xlsx';

    protected $columns = [
        'id' =>' ID',
        'class_number_parent' => '年级',
        'class_number_child' => '班级',
        'fullname' => '姓名',
        'id_card' => '身份证号',
        'phone' => '手机号',
        'remark' => '备注',
        'total_amount' => '支付金额',
        'paid_at' => '支付时间',
        'created_at' => '录入时间'
    ];

    public function map($data): array
    {
        return [
            $data->id,
            Input::CLASS_NUMBER_PARENT[$data->class_number_parent] ?? '-',
            Input::CLASS_NUMBER_CHILD[$data->class_number_child] ?? '-',
            $data->fullname,
            '\'' . $data->id_card,
            '\'' . $data->phone,
            $data->remark,
            $data->total_amount,
            $data->paid_at,
            $data->created_at
        ];
    }
}



//CREATE TABLE `inputs` (
//`id` bigint unsigned NOT NULL AUTO_INCREMENT,
//  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
//  `id_card` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
//  `phone` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
//  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
//  `input_ip` int unsigned NOT NULL DEFAULT '0',
//  `no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `total_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
//  `paid_at` datetime DEFAULT NULL,
//  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
//  `payment_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
//  `created_at` timestamp NULL DEFAULT NULL,
//  `updated_at` timestamp NULL DEFAULT NULL,
//  PRIMARY KEY (`id`),
//  UNIQUE KEY `inputs_no_unique` (`no`)
//) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
