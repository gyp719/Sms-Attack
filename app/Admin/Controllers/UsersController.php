<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class UsersController extends AdminController
{
    protected function grid(): Grid
    {
        return Grid::make(new User(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name')->badge('info');
            $grid->column('phone')->label('success');
            $grid->column('identity')->label();
            $grid->column('updated_at');

            // 快捷搜索
            $grid->quickSearch('id', 'name', 'phone', 'updated_at')->placeholder('搜索ID、姓名、手机号、身份证号码');;

        });
    }

    protected function detail($id): Show
    {
        return Show::make($id, new User(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('phone');
            $show->field('identity');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    protected function form(): Form
    {
        return Form::make(new User(), function (Form $form) {
            $form->display('id');
            $form->text('name')->required();
            $form->mobile('phone')->required();
            $form->text('identity')->required();

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
