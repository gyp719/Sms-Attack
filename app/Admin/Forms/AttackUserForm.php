<?php

namespace App\Admin\Forms;

use App\Jobs\SendSmsJob;
use App\Models\AttackUser;
use App\Models\SmsTemplate;
use App\Models\User;
use Dcat\Admin\Contracts\LazyRenderable;
use Dcat\Admin\Traits\LazyWidget;
use Dcat\Admin\Widgets\Form;
use Dcat\Admin\Http\JsonResponse;

class AttackUserForm extends Form implements LazyRenderable
{
    use LazyWidget;

    public function handle(array $input): JsonResponse
    {
        // 处理提交过来的批量选择的行的id
        $ids = explode(',', $input['id'] ?? null);
        if (!head($ids)) {
            return $this->response()->error('请至少选择一个短信模版')->refresh();
        }
        // 攻击模版
        $smsTemplates = SmsTemplate::query()->where('status', SmsTemplate::STATUS_ON)->whereIn('id', $ids)->get();
        // 攻击类型
        switch ($input['attack_type']) {
            default:
                // 消耗
            case SmsTemplate::ATTACK_TYPE_CONSUME:
                // 攻击用户
                $users = AttackUser::query()->get(['id', 'phone']);

                foreach ($smsTemplates as $smsTemplate) {
                    foreach ($users as $user) {
                        // 触发短信任务
                        dispatch(new SendSmsJob($smsTemplate, $user['phone']));
                    }
                }
                break;

            // 攻击
            case SmsTemplate::ATTACK_TYPE_ATTACK:
                // 攻击用户
                $users = User::query()->whereIn('id', $input['attack_user_id'])->get(['id', 'phone']);

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
        $this->radio('attack_type', '攻击类型')
            ->options(SmsTemplate::$attackTypeMap)
            ->when(SmsTemplate::ATTACK_TYPE_ATTACK, function (Form $form) {
                $form->multipleSelect('attack_user_id', '攻击用户')->options(User::query()->pluck('phone', 'id'));
            })
            ->when(SmsTemplate::ATTACK_TYPE_CONSUME, function (Form $form) {

            })
            ->required();
        // 设置隐藏表单，传递短信模版id
        $this->hidden('id')->attribute('id', 'attack-user-id');
    }
}
