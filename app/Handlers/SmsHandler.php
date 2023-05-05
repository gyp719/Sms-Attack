<?php

namespace App\Handlers;

use App\Models\SmsLog;
use App\Models\SmsTemplate;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Log;

class SmsHandler
{
    public function send(SmsTemplate $smsTemplate, $phone)/*: Response*/
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
            // 短信模版的成功响应
            $success_response_array = json_decode($smsTemplate['success_response'], true);
            // 判断 JSON 数据具有相同的结构
            if (blank(array_diff_key($response->json(), $success_response_array))) {
                $smsLog['send_status'] = SmsLog::SEND_STATUS_SUCCESS;
            } else {
                $smsLog['send_status'] = SmsLog::SEND_STATUS_FAIL;
            }
            $smsLog->save();
        } else {
            Log::info("'短信模版签名:{$smsTemplate['sign_name']}, 错误信息：{$response}");
        }

        return $response;
    }

}
