<?php

namespace App\Admin\Controllers;

use App\Models\SmsLog;
use App\Models\SmsTemplate;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;

class SmsLogsController extends AdminController
{
    protected function grid(): Grid
    {
        return Grid::make(new SmsLog(), function (Grid $grid) {
            $grid->model()->orderBy('id', 'DESC')->with('smsTemplate');
            $grid->column('id')->sortable();
            $grid->column('smsTemplate.sign_name', '短信签名')->label('#444');
            $grid->column('phone')->label('success');
            $grid->column('description');
            $grid->column('send_status')->display(function ($value) {
                return SmsLog::$sendStatusMap[$value];
            })->badge([
                SmsLog::SEND_STATUS_SUCCESS => 'success',
                SmsLog::SEND_STATUS_FAIL    => 'danger',
            ]);
            $grid->column('created_at');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->equal('sms_template_id')->select(SmsTemplate::query()->pluck('sign_name', 'id'));
                $filter->like('phone');
                $filter->equal('send_status')->radio(SmsLog::$sendStatusMap);
            });

            // 禁用创建
            $grid->disableCreateButton();
            // 禁用行编辑
            $grid->disableEditButton();
        });
    }

    protected function form()
    {
        return Form::make(new SmsLog(), function (Form $form) {
        });
    }
}
