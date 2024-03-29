<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_templates', function (Blueprint $table) {
            $table->comment('短信模版');

            $table->id();
            $table->string('sign_name')->comment('签名名称');
            $table->string('url')->unique()->comment('请求地址');
            $table->string('method')->comment('请求方法');
            $table->string('request_option')->comment('请求选项');
            $table->string('options')->comment('请求参数');
            $table->string('headers', 500)->nullable()->comment('请求头');
            $table->string('success_response', 1000)->comment('成功响应');
            $table->smallInteger('status')->default(0)->comment('状态 0-关闭 1-开始 2-废弃');
            $table->string('source')->comment('来源');
            $table->string('source_url')->nullable()->comment('来源地址');
            $table->string('source_image')->nullable()->comment('来源图片');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_templates');
    }
};
