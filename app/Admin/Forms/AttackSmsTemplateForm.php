<?php

namespace App\Admin\Forms;

use App\Models\SmsTemplate;
use Dcat\Admin\Contracts\LazyRenderable;
use Dcat\Admin\Traits\LazyWidget;
use Dcat\Admin\Widgets\Form;

class AttackSmsTemplateForm extends Form implements LazyRenderable
{
    use LazyWidget;

    public function handle(array $input)
    {
        // 处理提交过来的批量选择的行的id
        $ids = explode(',', $input['id'] ?? null);
        if (!head($ids)) {
            return $this->response()->error('请至少选择一个用户')->refresh();
        }


//        logger($id);

        return $this
            ->response()
            ->success('Processed successfully.')
            ->refresh();
    }

    public function form()
    {
        $this->radio('attack_type', '攻击方式')
            ->options(SmsTemplate::$attackWayMap)
            ->when(SmsTemplate::ATTACK_WAY_ASSIGN, function (Form $form) {
                $form->multipleSelect('attack_template', '攻击短信模版')->options(SmsTemplate::query()->where('status', SmsTemplate::STATUS_ON)->pluck('sign_name', 'id'));
            })->when(SmsTemplate::ATTACK_WAY_ASSIGN, function (Form $form) {

            })->required();
        // 设置隐藏表单，传递用户id
        $this->hidden('id')->attribute('id', 'attack-sms-template-id');
    }
    
}
