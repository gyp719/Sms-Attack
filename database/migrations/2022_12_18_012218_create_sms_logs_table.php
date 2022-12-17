<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\SmsLog;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_logs', function (Blueprint $table) {
            $table->comment('短信发送日志');

            $table->id();
            $table->unsignedBigInteger('sms_template_id')->comment('短信模版ID');
            $table->string('phone')->comment('手机号');
            $table->string('description')->comment('说明');
            $table->string('send_status')->default(SmsLog::SEND_STATUS_SUCCESS)->comment('发送状态');
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
        Schema::dropIfExists('sms_logs');
    }
};
