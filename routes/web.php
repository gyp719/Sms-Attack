<?php

use App\Handlers\SmsHandler;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    $smsTemplate = \App\Models\SmsTemplate::query()->where('id', 5)->first();

    $smsHandler = new SmsHandler();

    return $smsHandler->send($smsTemplate, 15172441211);

    return view('welcome');
});
