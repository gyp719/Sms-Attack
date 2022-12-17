<?php

namespace App\Admin\Actions\Grid;

use App\Admin\Forms\AttackSmsTemplateForm;
use Dcat\Admin\Grid\BatchAction;
use Dcat\Admin\Widgets\Modal;

class AttackSmsTemplate extends BatchAction
{
    protected $title = '攻击';

    public function render(): string|Modal
    {
        // 实例化表单类
        $form = AttackSmsTemplateForm::make();

        return Modal::make()
            ->lg()
            ->title($this->title)
            ->body($form)
            ->onLoad($this->getModalScript())
            ->button("<a class='btn btn-danger' style='color: white;'><i class='feather icon-slack'></i>&nbsp;$this->title</a >");
    }

    protected function getModalScript(): string
    {
        // 弹窗显示后往隐藏的id表单中写入批量选中的行ID
        return <<<JS
// 获取选中的ID数组
var key = {$this->getSelectedKeysScript()}
// 与 弹窗隐藏的绑定的id一致
$('#sms-template-id').val(key);
JS;
    }
}
