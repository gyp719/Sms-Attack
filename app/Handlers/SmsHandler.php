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

        // 是否包含 phone 键, 存在替换为手机号
        foreach ($smsTemplate['options'] as $key => $value) {
            if ($smsTemplate['request_option'] == SmsTemplate::REQUEST_OPTION_MULTIPART) {
                $options[] = [
                    'name'     => $key,
                    'contents' => $value == config('app.mapping_phone') ? "{$phone}" : $value,
                ];
            } else {
                $options[$key] = $value == config('app.mapping_phone') ? "{$phone}" : $value;
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
        $response = Http::send($smsTemplate['method'], str_replace(config('app.mapping_phone'), $phone, $smsTemplate['url']), $request_params);

        if ($response->successful() || $response->json()) {
            $smsLog = new SmsLog([
                'phone'       => $phone,
                'description' => $response->json() ?: $response->body(),
            ]);
            $smsLog->smsTemplate()->associate($smsTemplate);

            if (
                isset($response['code']) && in_array($response['code'], [0, 1, 200, 10000]) ||
                isset($response['d']) && $response['d'] == 'suc' ||
                isset($response['status_code']) && in_array($response['status_code'], [200, 201]) ||
                isset($response['success']) && $response['success'] == 1 ||
                isset($response['ticket']) ||
                isset($response['errcode']) && $response['errcode'] == 0 ||
                isset($response['err']) && $response['err'] == 0 ||
                isset($response['businessCode']) && $response['businessCode'] == 1000 ||
                isset($response['result']) && $response['result']['resultCode'] == 200 ||
                is_numeric($response->json()) ||
                isset($response['responseCode']) && $response['responseCode'] == 0 ||
                isset($response['status']) && in_array($response['status'], [0, 200]) ||
                isset($response['type']) && $response['type'] == 'verifycode.send' ||
                isset($response['state']) && $response['state'] == 'success' ||
                isset($response['ret']) && $response['ret'] == 1 ||
                isset($response['stat']) && $response['stat'] == 1
            ) {
                $smsLog['send_status'] = SmsLog::SEND_STATUS_SUCCESS;
            } else {
                $smsLog['send_status'] = SmsLog::SEND_STATUS_FAIL;
            }
            $smsLog->save();
        } else {
            logger("'短信模版签名:{$smsTemplate['sign_name']}, 错误信息：{$response}");
        }

        return $response;
    }

}
