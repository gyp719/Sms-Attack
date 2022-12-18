<?php

namespace App\Handlers;

use App\Models\SmsLog;
use App\Models\SmsTemplate;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class SmsHandler
{
    public function send(SmsTemplate $smsTemplate, $phone): Response
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

        if ($response->successful()) {
            // 定义返回信息的键
            $messageKeys = ['message', 'msg'];

            foreach ($messageKeys as $messageKey) {
                if (array_key_exists($messageKey, $response->json())) {
                    break;
                }
            }

            $smsLog = new SmsLog([
                'phone'       => $phone,
                'description' => $response[$messageKey],
            ]);
            $smsLog->smsTemplate()->associate($smsTemplate);
            // 0 成功
            if (in_array($response['code'], [0, 200])) {
                $smsLog['send_status'] = SmsLog::SEND_STATUS_SUCCESS;
            } else {
                $smsLog['send_status'] = SmsLog::SEND_STATUS_FAIL;
            }
            $smsLog->save();
        } else {
            logger($response);
        }

        return $response;
    }

}
