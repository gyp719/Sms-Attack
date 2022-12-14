<?php

use Dcat\Admin\Admin;
use Dcat\Admin\Grid;
use Dcat\Admin\Form;
use Dcat\Admin\Grid\Filter;
use Dcat\Admin\Show;

/**
 * Dcat-admin - admin builder based on Laravel.
 * @author jqh <https://github.com/jqhph>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 *
 * extend custom field:
 * Dcat\Admin\Form::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Column::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Filter::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */
Grid::resolving(function (Grid $grid) {
    // 禁止 outline 模式
    $grid->toolsWithOutline(false);
    // 列表去掉`查看`
    $grid->showViewButton(false);
});

Form::resolving(function (Form $form) {
    // 底部去掉`查看`
    $form->footer(function (Form\Footer $footer) {
        $footer->disableViewCheck();
    });
    // 详情去掉`查看`
    $form->tools(function (Form\Tools $tools) {
        $tools->disableView();
    });
});
