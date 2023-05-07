<?php

namespace App\Admin\Controllers;

use App\Models\ProxyIp;
use Dcat\Admin\Form;
use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Http\RedirectResponse;

class ProxyIpsController extends AdminController
{
    protected function grid(): RedirectResponse
    {
        return back();
    }

    protected function form(): Form
    {
        return Form::make(new ProxyIp(), function (Form $form) {
            $form->display('id');
            $form->textarea('ips')->rows(20)->help('如有多个，换行填写');

            $form->display('created_at');
            $form->display('updated_at');

            $form->disableListButton();
            $form->disableDeleteButton();
        });
    }


}
