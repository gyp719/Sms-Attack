<?php

namespace App\Models;

use App\Models\Traits\SerializeDate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsTemplate extends Model
{
    use HasFactory, SerializeDate;

    protected $casts = [
        'options' => 'json',
        'headers' => 'json',
    ];

    protected $fillable = [
        'sign_name',
        'url',
        'method',
        'request_option',
        'options',
        'headers',
        'status',
        'source',
        'source_url',
        'source_image',
    ];

    // 请求方式
    const METHOD_GET  = 'GET';
    const METHOD_POST = 'POST';

    public static array $methodMap = [
        self::METHOD_GET  => 'GET',
        self::METHOD_POST => 'POST',
    ];

    // 状态
    const STATUS_OFF     = 0;
    const STATUS_ON      = 1;
    const STATUS_ABANDON = 2;

    public static array $statusMap = [
        self::STATUS_OFF     => '关闭',
        self::STATUS_ON      => '开启',
        self::STATUS_ABANDON => '废弃',
    ];

    // 请求选项
    // form-data 对应请求头 multipart/form-data
    // x-www-form-urlencoded 对应请求头 application/x-www-form-urlencoded
    const REQUEST_OPTION_QUERY       = 'query';
    const REQUEST_OPTION_MULTIPART   = 'multipart';
    const REQUEST_OPTION_FORM_PARAMS = 'form_params';
    const REQUEST_OPTION_JSON        = 'json';

    public static array $requestOptionMap = [
        self::REQUEST_OPTION_QUERY       => 'query',
        self::REQUEST_OPTION_MULTIPART   => 'multipart/form-data',
        self::REQUEST_OPTION_FORM_PARAMS => 'application/x-www-form-urlencoded',
        self::REQUEST_OPTION_JSON        => 'application/json',
    ];

    // 来源
    const SOURCE_WEB          = 'web';
    const SOURCE_H5           = 'h5';
    const SOURCE_MINI_PROGRAM = 'mini_program';

    public static array $sourceMap = [
        self::SOURCE_WEB          => 'PC',
        self::SOURCE_H5           => 'H5',
        self::SOURCE_MINI_PROGRAM => '小程序',
    ];

    // 攻击类型
    const ATTACK_TYPE_ATTACK  = 'attack';
    const ATTACK_TYPE_CONSUME = 'consume';

    public static array $attackTypeMap = [
        self::ATTACK_TYPE_ATTACK  => '攻击',
        self::ATTACK_TYPE_CONSUME => '消耗',
    ];

    // 攻击方式
    const ATTACK_WAY_ALL    = 'all';
    const ATTACK_WAY_ASSIGN = 'assign';

    public static array $attackWayMap = [
        self::ATTACK_WAY_ALL    => '所有',
        self::ATTACK_WAY_ASSIGN => '指定',
    ];


}
