<?php

namespace App\Admin\Forms;

use App\Models\SmsTemplate;
use Dcat\Admin\Widgets\Form;

class AttackSmsTemplateForm extends Form
{
    public function handle(array $input)
    {

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
                $form->multipleSelect('attack_template', '攻击短信模版')->options(SmsTemplate::query()->pluck('sign_name', 'id'));
            })->when(SmsTemplate::ATTACK_WAY_ASSIGN, function (Form $form) {

            })->required();
    }

    public function default()
    {
        return [
            'name'  => 'John Doe',
            'email' => 'John.Doe@gmail.com',
        ];
    }
}
