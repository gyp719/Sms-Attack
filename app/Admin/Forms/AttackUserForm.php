<?php

namespace App\Admin\Forms;

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






        return $this->response()->success('提交成功')->refresh();
        $smsTemplates = SmsTemplate::query()->whereIn('id', $id)->get();

        switch ($input['attack_type']) {
            default:
            case SmsTemplate::ATTACK_TYPE_CONSUME:
                return 123;
                break;


            case SmsTemplate::ATTACK_TYPE_ATTACK:

                break;
        }


        //写你的处理逻辑
        foreach ($id as $key => $value) {

//            XXXXX::update(['flag'=>$flag,'opinion'=>$opinion]);

        }
        return $this->response()->success('提交成功')->refresh();

    }


    public function form()
    {
        $this->radio('attack_type', '攻击类型')
            ->options(SmsTemplate::$attackTypeMap)
            ->when(SmsTemplate::ATTACK_TYPE_ATTACK, function (Form $form) {
                $form->multipleSelect('attack_phone', '攻击用户')->options(User::query()->pluck('phone', 'id'));
            })
            ->when(SmsTemplate::ATTACK_TYPE_CONSUME, function (Form $form) {

            })
            ->required();
        // 设置隐藏表单，传递短信模版id
        $this->hidden('id')->attribute('id', 'attack-user-id');
    }
}
