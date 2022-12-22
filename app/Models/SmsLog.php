<?php

namespace App\Models;

use App\Models\Traits\SerializeDate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SmsLog extends Model
{
    use HasFactory, SerializeDate;

    protected $fillable = ['phone', 'description', 'send_status'];

    protected $casts = [
        'description' => 'json',
    ];

    // 发送状态
    const SEND_STATUS_SUCCESS = 'success';
    const SEND_STATUS_FAIL    = 'fail';

    public static array $sendStatusMap = [
        self::SEND_STATUS_SUCCESS => '成功',
        self::SEND_STATUS_FAIL    => '失败',
    ];

    // 所属短信模版
    public function smsTemplate(): BelongsTo
    {
        return $this->belongsTo(SmsTemplate::class);
    }

}
