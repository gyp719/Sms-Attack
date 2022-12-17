<?php

namespace App\Admin\Forms;

use App\Jobs\SendSmsJob;
use App\Models\SmsTemplate;
use App\Models\User;
use Dcat\Admin\Contracts\LazyRenderable;
use Dcat\Admin\Traits\LazyWidget;
use Dcat\Admin\Widgets\Form;
use Dcat\Admin\Http\JsonResponse;

class AttackSmsTemplateForm extends Form implements LazyRenderable
{
    use LazyWidget;

    public function handle(array $input): JsonResponse
    {
        // 处理提交过来的批量选择的行的id
        $ids = explode(',', $input['id'] ?? null);
        if (!head($ids)) {
            return $this->response()->error('请至少选择一个用户')->refresh();
        }
        // 攻击用户
        $users = User::query()->whereIn('id', $ids)->get(['id', 'phone']);
        // 攻击方式
        switch ($input['attack_type']) {
            // 指定
            case SmsTemplate::ATTACK_WAY_ASSIGN:
                // 攻击模版
                $smsTemplates = SmsTemplate::query()->where('status', SmsTemplate::STATUS_ON)->whereIn('id', $input['attack_template_id'])->get();
                if ($smsTemplates->isEmpty()) {
                    return $this->response()->error('指定攻击方式请至少选择一个短信模版')->refresh();
                }

                foreach ($smsTemplates as $smsTemplate) {
                    foreach ($users as $user) {
                        // 触发短信任务
                        dispatch(new SendSmsJob($smsTemplate, $user['phone']));
                    }
                }
                break;

                // 所有
            default:
            case SmsTemplate::ATTACK_WAY_ALL:
                // 攻击模版
                $smsTemplates = SmsTemplate::query()->where('status', SmsTemplate::STATUS_ON)->get();

                foreach ($smsTemplates as $smsTemplate) {
                    foreach ($users as $user) {
                        // 触发短信任务
                        dispatch(new SendSmsJob($smsTemplate, $user['phone']));
                    }
                }
                break;
        }

        return $this->response()->success('提交成功')->refresh();
    }

    public function form()
    {
        $this->radio('attack_type', '攻击方式')
            ->options(SmsTemplate::$attackWayMap)
            ->when(SmsTemplate::ATTACK_WAY_ASSIGN, function (Form $form) {
                $form->multipleSelect('attack_template_id', '攻击短信模版')->options(SmsTemplate::query()->where('status', SmsTemplate::STATUS_ON)->pluck('sign_name', 'id'));
            })->when(SmsTemplate::ATTACK_WAY_ALL, function (Form $form) {

            })->required();
        // 设置隐藏表单，传递用户id
        $this->hidden('id')->attribute('id', 'attack-sms-template-id');
    }
}
