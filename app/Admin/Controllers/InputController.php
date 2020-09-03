<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\InputsExporter;
use App\Models\Input;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class InputController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Input';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Input());

        $grid->column('id', __('Id'));
        $grid->column('fullname', __('Fullname'));
        $grid->column('id_card', __('Id card'));
        $grid->column('phone', __('Phone'));
        $grid->column('remark', __('Remark'));
//        $grid->column('input_ip', __('Input ip'));
//        $grid->column('no', __('No'));
        $grid->column('total_amount', __('Total amount'));
        $grid->column('paid_at', __('Paid at'));
        $grid->column('payment_method', __('Payment method'))->display(function ($val) {
            return Input::PAYMENT_METHOD[$val] ?: '';
        });
        $grid->column('class_number_parent', "年级")->display(function($val) {
            return Input::CLASS_NUMBER_PARENT[$val] ?? '-';
        });
        $grid->column('class_number_child', "班级")->display(function($val) {
            return Input::CLASS_NUMBER_CHILD[$val] ?? '-';
        });
//        $grid->column('payment_no', __('Payment no'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        // 定义导出类
        $grid->exporter(new InputsExporter());

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Input::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('fullname', __('Fullname'));
        $show->field('id_card', __('Id card'));
        $show->field('phone', __('Phone'));
        $show->field('remark', __('Remark'));
        $show->field('input_ip', __('Input ip'));
        $show->field('no', __('No'));
        $show->field('total_amount', __('Total amount'));
        $show->field('paid_at', __('Paid at'));
        $show->field('payment_method', __('Payment method'));
        $show->field('payment_no', __('Payment no'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Input());

        $form->text('fullname', __('Fullname'));
        $form->text('id_card', __('Id card'));
        $form->mobile('phone', __('Phone'));
        $form->text('remark', __('Remark'));
        $form->number('input_ip', __('Input ip'));
        $form->text('no', __('No'));
        $form->decimal('total_amount', __('Total amount'))->default(0.00);
        $form->datetime('paid_at', __('Paid at'))->default(date('Y-m-d H:i:s'));
        $form->select('payment_method', __('Payment method'))->options(Input::PAYMENT_METHOD);
        $form->text('payment_no', __('Payment no'));

        return $form;
    }
}
