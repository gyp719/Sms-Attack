<?php

namespace App\Handlers;

use App\Models\SmsTemplate;
use Illuminate\Support\Facades\Http;

class SmsHandler
{
    public function send(SmsTemplate $smsTemplate, $phone)
    {
        $options = [];
        // 搜是否包含 phone 键值，并返回对应的键名。
        if (($key = array_search('phone', $smsTemplate['options'])) !== false) {
            $options[$key] = $phone;
        }
        // 组装好请求参数
        $request_params = array(
            $smsTemplate['request_option'] => $options
        );
        // 存在 headers，追加参数
        if ($smsTemplate['headers']) {
            $request_params['headers'] = $smsTemplate['headers'];
        }
        
        // HTTP 客户端请求
        $response = Http::send($smsTemplate['method'], $smsTemplate['url'], $request_params);


        logger($response);
        return $response;
    }

}
