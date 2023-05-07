<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('sms_templates', 'SmsTemplatesController', ['except' => ['show'] ]); // 短信模版
    $router->resource('users', 'UsersController', ['except' => ['show'] ]); // 用户列表
    $router->resource('sms_logs', 'SmsLogsController', ['only' => ['index', 'destroy'] ]); // 短信日志
    $router->resource('proxy_ips', 'ProxyIpsController', ['only' => ['index', 'edit', 'update'] ]); // 代理ip
});
