<?php

namespace App\Handlers;

use App\Models\SmsLog;
use App\Models\SmsTemplate;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Log;

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
        $response = Http::withOptions(['verify' => false])->send($smsTemplate['method'], str_replace(config('app.mapping_phone'), $phone, $smsTemplate['url']), $request_params);

        if ($response->successful() || $response->json()) {
            $smsLog = new SmsLog([
                'phone'       => $phone,
                'description' => $response->json() ?: $response->body(),
            ]);
            $smsLog->smsTemplate()->associate($smsTemplate);
            // 短信模版的成功响应
            $success_response_array = json_decode($smsTemplate['success_response'], true);
            // 判断 JSON 数据具有相同的结构
            if (is_numeric($response->json()) ||
                (isset($response['code']) && $response['code'] == $success_response_array['code'] && isset($response['message']) && $response['message'] == $success_response_array['message']) ||
                (isset($response['code']) && $response['code'] == $success_response_array['code'] && isset($response['msg']) && $response['msg'] == $success_response_array['msg']) ||
                (isset($response['code']) && $response['code'] == $success_response_array['code'] && isset($response['status']) && $response['status'] == $success_response_array['status']) ||
                (isset($response['code']) && $response['code'] == $success_response_array['code'] && isset($response['error']) && $response['error'] == $success_response_array['error']) ||
                (isset($response['code']) && $response['code'] == $success_response_array['code'] && isset($response['data']) && $response['data'] == $success_response_array['data']) ||
                (isset($response['code']) && $response['code'] == $success_response_array['code'] && isset($response['desc']) && $response['desc'] == $success_response_array['desc']) ||
                (isset($response['code']) && $response['code'] == $success_response_array['code'] && isset($response['info']) && $response['info'] == $success_response_array['info']) ||

                (isset($response['errcode']) && $response['errcode'] == $success_response_array['errcode'] && isset($response['message']) && $response['message'] == $success_response_array['message']) ||
                (isset($response['errcode']) && $response['errcode'] == $success_response_array['errcode'] && isset($response['errmsg']) && $response['errmsg'] == $success_response_array['errmsg']) ||

                (isset($response['status_code']) && $response['status_code'] == $success_response_array['status_code'] && isset($response['message']) && $response['message'] == $success_response_array['message']) ||
                (isset($response['errorCode']) && $response['errorCode'] == $success_response_array['errorCode'] && isset($response['errorDesc']) && $response['errorDesc'] == $success_response_array['errorDesc']) ||
                (isset($response['resultcode']) && $response['resultcode'] == $success_response_array['resultcode'] && isset($response['message']) && $response['message'] == $success_response_array['message']) ||
                (isset($response['businessCode']) && $response['businessCode'] == $success_response_array['businessCode'] && isset($response['content']) && $response['content'] == $success_response_array['content']) ||
                (isset($response['slResponseCode']) && $response['slResponseCode'] == $success_response_array['slResponseCode'] && isset($response['message']) && $response['message'] == $success_response_array['message']) ||

                (isset($response['status']) && $response['status'] == $success_response_array['status'] && isset($response['message']) && $response['message'] == $success_response_array['message']) ||

                (isset($response['success']) && $response['success'] == $success_response_array['success'] && isset($response['request_id']) && is_numeric($response['request_id'])) ||
                (isset($response['success']) && $response['success'] == $success_response_array['success'] && isset($response['message']) && $response['message'] == $success_response_array['message']) ||

                (isset($response['err']) && $response['err'] == $success_response_array['err'] && isset($response['msg']) && $response['msg'] == $success_response_array['msg']) ||
                (isset($response['isSuccess']) && $response['isSuccess'] == $success_response_array['isSuccess'] && isset($response['message']) && $response['message'] == $success_response_array['message']) ||
                (isset($response['ret']) && $response['ret'] == $success_response_array['ret'] && isset($response['msg']) && $response['msg'] == $success_response_array['msg']) ||
                (isset($response['stat']) && $response['stat'] == $success_response_array['stat'] && isset($response['msg']) && $response['msg'] == $success_response_array['msg']) ||
                (isset($response['state']) && $response['state'] == $success_response_array['state'] && isset($response['success']) && $response['success'] == $success_response_array['success']) ||
                (isset($response['operating']) && $response['operating'] == $success_response_array['operating'] && isset($response['type']) && $response['type'] == $success_response_array['type']) ||

                (isset($response['code']) && $response['code'] == $success_response_array['code']) ||
                (isset($response['ok']) && $response['ok'] == $success_response_array['ok']) ||
                (isset($response['status']) && $response['status'] == $success_response_array['status']) ||
                (isset($response['result']) && $response['result'] == $success_response_array['result']) ||
                (isset($response['data']) && $response['data'] == $success_response_array['data']) ||
                (isset($response['d']) && $response['d'] == $success_response_array['d']) ||
                (isset($response['ticket']) && strlen($response['ticket']) >= 30) ||

                (isset($response['success']) && $response['success'] == $success_response_array['success'] && is_null($success_response_array['errorCode']))
            ) {
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
