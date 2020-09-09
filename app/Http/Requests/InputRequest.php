<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InputRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'fullname' => 'required',
                    'id_card' => 'required|identitycards',
                    'phone' => 'required|telphone',
                    'payment_method' => 'required|in:cash,wechat,alipay',
                    'no' => 'required',
                    'input_ip' => 'required',
                    'total_amount' => 'required|in:300,100,200',
                    'class_number_parent' => 'required',
                    'class_number_child' => 'required',
                    'school_id' => 'required|exists:schools,id'
                ];
            default :
                return [];
        }
    }

    public function messages()
    {
        return [
            'fullname.required' => '请输入姓名',
            'id_card.required' => '请输入身份证号',
            'id_card.identitycards' => '请输入正确的身份证号',
            'phone.required' => '请输入手机号',
            'phone.telphone' => '请输入正确的手机号',
            'payment_method.required' => '支付方式错误',
            'payment_method.in' => '支付方式错误',
            'no.required' => '参数错误',
            'input_ip.required' => '参数错误',
            'total_amount.require' => '参数错误',
            'total_amount.in' => '参数错误',
            'class_number_parent.require' => '参数错误',
            'class_number_child.require' => '参数错误',
            'school_id.required' => '学校信息错误，请重新扫码',
            'school_id.exists' => '学校信息错误，请重新扫码'
        ];
    }
}
