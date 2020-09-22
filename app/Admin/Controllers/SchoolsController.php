<?php

namespace App\Admin\Controllers;

use App\Models\School;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SchoolsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'School';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new School());

//        $grid->column('id', __('Id'));
        $grid->column('name', '学校名称');
        $grid->column('id', '二维码')->display(function ($id) {
            $url = route('root', ['school_id' => $id]);
            return '<img src="/qrcode?url=' . $url . '"/>';
        });
        $grid->column('is_default', '是否默认');
        $grid->column('is_open', '是否启用')->switch([
            'on'  => ['value' => 1, 'text' => '打开', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '关闭', 'color' => 'danger'],
        ]);
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(School::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', '学校名称');
        $show->field('is_default', '是否默认');
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
        $form = new Form(new School());

        $form->text('name', '学校名称');
        $form->switch('is_open', '是否启用')->states([
            'on'  => ['value' => 1, 'text' => '打开', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '关闭', 'color' => 'danger'],
        ]);
        $form->switch('is_default', '是否默认');

        return $form;
    }
}
