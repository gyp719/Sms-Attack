<?php

namespace App\Handlers;

use App\Models\SmsLog;
use App\Models\SmsTemplate;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class SmsHandler
{
    public function send(SmsTemplate $smsTemplate, $phone)/*: Response*/
    {
        $options = [];

        // 是否包含 phone 键, 存在替换为手机号
        foreach ($smsTemplate['options'] as $key => $value) {
            if ($smsTemplate['request_option'] == SmsTemplate::REQUEST_OPTION_MULTIPART) {
                $options[] = [
                    'name' => $key,
                    'contents' => $value == 'phone' ? $phone : $value,
                ];
            } else {
                $options[$key] =  $value == 'phone' ? $phone : $value;
            }
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

        if ($response->successful() ||
            isset($response['status']) ||
            isset($response['success']) ||
            isset($response['type']) ||
            isset($response['message'])
        ) {
            // 定义返回信息的键
            $messageKeys = ['message', 'msg', 'info', 'errorMsg', 'operating', 'type', 'status', 'data'];

            foreach ($messageKeys as $messageKey) {
                if (array_key_exists($messageKey, $response->json())) {
                    break;
                }
            }

            $smsLog = new SmsLog([
                'phone'       => $phone,
                'description' => $response[$messageKey] ?: '',
            ]);
            $smsLog->smsTemplate()->associate($smsTemplate);

            if (
                (isset($response['code']) && in_array($response['code'], [0, 200])) ||
                (isset($response['status']) &&  in_array($response['status'], [0, 200])) ||
                (isset($response['success']) && $response['success'] == true)
            ) {
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
