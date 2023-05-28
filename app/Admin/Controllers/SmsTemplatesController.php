<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\AttackUser;
use App\Models\SmsTemplate;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;

class SmsTemplatesController extends AdminController
{
    protected function grid(): Grid
    {
        return Grid::make(new SmsTemplate(), function (Grid $grid) {
            $grid->model()->orderBy('id', 'DESC');
            $grid->column('id')->sortable();
            $grid->column('sign_name')->label('#444');
            $grid->column('method')->display(function ($value) {
                return SmsTemplate::$methodMap[$value];
            })->label([
                SmsTemplate::METHOD_GET  => 'primary',
                SmsTemplate::METHOD_POST => 'success',
            ]);
            $grid->column('request_option')->display(function ($value) {
                return SmsTemplate::$requestOptionMap[$value];
            })->badge([
                SmsTemplate::REQUEST_OPTION_QUERY       => 'pink',
                SmsTemplate::REQUEST_OPTION_MULTIPART   => 'primary',
                SmsTemplate::REQUEST_OPTION_FORM_PARAMS => 'success',
                SmsTemplate::REQUEST_OPTION_JSON        => 'info',
            ]);
            $grid->column('options')->display(function ($value) {
                //  转化为json 字符串
                return $value ? json_encode($value) : '';
            })->copyable();
            $grid->column('status')->select(SmsTemplate::$statusMap);
            $grid->column('source')->display(function ($value) {
                return SmsTemplate::$sourceMap[$value];
            })->badge([
                SmsTemplate::SOURCE_WEB          => 'primary',
                SmsTemplate::SOURCE_H5           => 'success',
                SmsTemplate::SOURCE_MINI_PROGRAM => 'info',
            ]);
            $grid->column('updated_at');

            // 快捷搜索
            $grid->quickSearch('id', 'sign_name', 'url')->placeholder('搜索ID、签名名称、请求地址');;

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('sign_name');

                $filter->equal('method')->radio(SmsTemplate::$methodMap);
                $filter->equal('request_option')->select(SmsTemplate::$requestOptionMap);
                $filter->equal('status')->radio(SmsTemplate::$statusMap);
                $filter->equal('source')->select(SmsTemplate::$sourceMap);
            });

            $grid->tools(new AttackUser());
        });
    }

    protected function form(): Form
    {
        return Form::make(new SmsTemplate(), function (Form $form) {
            $form->display('id');
            $form->text('sign_name')->required();
            $form->text('url')->prepend('<i class="fa fa-internet-explorer fa-fw"></i>')->required();
            $form->radio('method')->options(SmsTemplate::$methodMap)->default(SmsTemplate::METHOD_POST)->required();
            $form->radio('request_option')->options(SmsTemplate::$requestOptionMap)->default(SmsTemplate::REQUEST_OPTION_MULTIPART)->required();
            $form->keyValue('headers');
            $form->keyValue('options')->default(['' => config('app.mapping_phone')])->required();
            $form->textarea('success_response')->rows(10)->help("<a href='https://www.sojson.com' target='_blank'>在线Json格式化</a>");
            $form->radio('status')->options(SmsTemplate::$statusMap)->default(SmsTemplate::STATUS_ON)->required();
            $form->radio('source')->options(SmsTemplate::$sourceMap)
                ->when([SmsTemplate::SOURCE_WEB, SmsTemplate::SOURCE_H5], function (Form $form) {
                    $form->url('source_url');
                })->when(SmsTemplate::SOURCE_MINI_PROGRAM, function (Form $form) {
                    $form->image('source_image')->chunkSize(500)->autoUpload();;
                })->default(SmsTemplate::SOURCE_WEB)->required();

            $form->display('created_at');
            $form->display('updated_at');

            $form->saved(function (Form $form, $result) {
                // 在表单保存后获取eloquent
                $headers = $form->input('headers');
                if ($headers && (!array_key_exists('keys', $headers) || (!array_key_exists('values', $headers)))) {
                    $form->model()->update(['headers' => '']);
                }

            });
        });
    }
}
