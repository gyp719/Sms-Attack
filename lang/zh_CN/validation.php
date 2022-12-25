<?php

/*
|--------------------------------------------------------------------------
| Validation Language Lines
|--------------------------------------------------------------------------
|
| The following language lines contain the default error messages used by
| the validator class. Some of these rules have multiple versions such
| as the size rules. Feel free to tweak each of these messages here.
|
*/

return [
    'accepted'             => '您必须接受 :attribute。',
    'accepted_if'          => '当 :other 为 :value 时，必须接受 :attribute。',
    'active_url'           => ':attribute 不是一个有效的网址。',
    'after'                => ':attribute 必须要晚于 :date。',
    'after_or_equal'       => ':attribute 必须要等于 :date 或更晚。',
    'alpha'                => ':attribute 只能由字母组成。',
    'alpha_dash'           => ':attribute 只能由字母、数字、短划线(-)和下划线(_)组成。',
    'alpha_num'            => ':attribute 只能由字母和数字组成。',
    'array'                => ':attribute 必须是一个数组。',
    'before'               => ':attribute 必须要早于 :date。',
    'before_or_equal'      => ':attribute 必须要等于 :date 或更早。',
    'between'              => [
        'array'   => ':attribute 必须只有 :min - :max 个单元。',
        'file'    => ':attribute 必须介于 :min - :max KB 之间。',
        'numeric' => ':attribute 必须介于 :min - :max 之间。',
        'string'  => ':attribute 必须介于 :min - :max 个字符之间。',
    ],
    'boolean'              => ':attribute 必须为布尔值。',
    'confirmed'            => ':attribute 两次输入不一致。',
    'current_password'     => '密码错误。',
    'date'                 => ':attribute 不是一个有效的日期。',
    'date_equals'          => ':attribute 必须要等于 :date。',
    'date_format'          => ':attribute 的格式必须为 :format。',
    'declined'             => ':attribute 必须是拒绝的。',
    'declined_if'          => '当 :other 为 :value 时字段 :attribute 必须是拒绝的。',
    'different'            => ':attribute 和 :other 必须不同。',
    'digits'               => ':attribute 必须是 :digits 位数字。',
    'digits_between'       => ':attribute 必须是介于 :min 和 :max 位的数字。',
    'dimensions'           => ':attribute 图片尺寸不正确。',
    'distinct'             => ':attribute 已经存在。',
    'email'                => ':attribute 不是一个合法的邮箱。',
    'ends_with'            => ':attribute 必须以 :values 为结尾。',
    'enum'                 => ':attribute 值不正确。',
    'exists'               => ':attribute 不存在。',
    'file'                 => ':attribute 必须是文件。',
    'filled'               => ':attribute 不能为空。',
    'gt'                   => [
        'array'   => ':attribute 必须多于 :value 个元素。',
        'file'    => ':attribute 必须大于 :value KB。',
        'numeric' => ':attribute 必须大于 :value。',
        'string'  => ':attribute 必须多于 :value 个字符。',
    ],
    'gte'                  => [
        'array'   => ':attribute 必须多于或等于 :value 个元素。',
        'file'    => ':attribute 必须大于或等于 :value KB。',
        'numeric' => ':attribute 必须大于或等于 :value。',
        'string'  => ':attribute 必须多于或等于 :value 个字符。',
    ],
    'image'                => ':attribute 必须是图片。',
    'in'                   => '已选的属性 :attribute 无效。',
    'in_array'             => ':attribute 必须在 :other 中。',
    'integer'              => ':attribute 必须是整数。',
    'ip'                   => ':attribute 必须是有效的 IP 地址。',
    'ipv4'                 => ':attribute 必须是有效的 IPv4 地址。',
    'ipv6'                 => ':attribute 必须是有效的 IPv6 地址。',
    'json'                 => ':attribute 必须是正确的 JSON 格式。',
    'lt'                   => [
        'array'   => ':attribute 必须少于 :value 个元素。',
        'file'    => ':attribute 必须小于 :value KB。',
        'numeric' => ':attribute 必须小于 :value。',
        'string'  => ':attribute 必须少于 :value 个字符。',
    ],
    'lte'                  => [
        'array'   => ':attribute 必须少于或等于 :value 个元素。',
        'file'    => ':attribute 必须小于或等于 :value KB。',
        'numeric' => ':attribute 必须小于或等于 :value。',
        'string'  => ':attribute 必须少于或等于 :value 个字符。',
    ],
    'mac_address'          => ':attribute 必须是一个有效的 MAC 地址。',
    'max'                  => [
        'array'   => ':attribute 最多只有 :max 个单元。',
        'file'    => ':attribute 不能大于 :max KB。',
        'numeric' => ':attribute 不能大于 :max。',
        'string'  => ':attribute 不能大于 :max 个字符。',
    ],
    'mimes'                => ':attribute 必须是一个 :values 类型的文件。',
    'mimetypes'            => ':attribute 必须是一个 :values 类型的文件。',
    'min'                  => [
        'array'   => ':attribute 至少有 :min 个单元。',
        'file'    => ':attribute 大小不能小于 :min KB。',
        'numeric' => ':attribute 必须大于等于 :min。',
        'string'  => ':attribute 至少为 :min 个字符。',
    ],
    'multiple_of'          => ':attribute 必须是 :value 中的多个值。',
    'not_in'               => '已选的属性 :attribute 非法。',
    'not_regex'            => ':attribute 的格式错误。',
    'numeric'              => ':attribute 必须是一个数字。',
    'password'             => '密码错误',
    'present'              => ':attribute 必须存在。',
    'prohibited'           => ':attribute 字段被禁止。',
    'prohibited_if'        => '当 :other 为 :value 时，禁止 :attribute 字段。',
    'prohibited_unless'    => ':attribute 字段被禁止，除非 :other 位于 :values 中。',
    'prohibits'            => ':attribute 字段禁止出现 :other。',
    'regex'                => ':attribute 格式不正确。',
    'required'             => ':attribute 不能为空。',
    'required_array_keys'  => ':attribute 至少包含指定的键：:values.',
    'required_if'          => '当 :other 为 :value 时 :attribute 不能为空。',
    'required_unless'      => '当 :other 不为 :values 时 :attribute 不能为空。',
    'required_with'        => '当 :values 存在时 :attribute 不能为空。',
    'required_with_all'    => '当 :values 存在时 :attribute 不能为空。',
    'required_without'     => '当 :values 不存在时 :attribute 不能为空。',
    'required_without_all' => '当 :values 都不存在时 :attribute 不能为空。',
    'same'                 => ':attribute 和 :other 必须相同。',
    'size'                 => [
        'array'   => ':attribute 必须为 :size 个单元。',
        'file'    => ':attribute 大小必须为 :size KB。',
        'numeric' => ':attribute 大小必须为 :size。',
        'string'  => ':attribute 必须是 :size 个字符。',
    ],
    'starts_with'          => ':attribute 必须以 :values 为开头。',
    'string'               => ':attribute 必须是一个字符串。',
    'timezone'             => ':attribute 必须是一个合法的时区值。',
    'unique'               => ':attribute 已经存在。',
    'uploaded'             => ':attribute 上传失败。',
    'url'                  => ':attribute 格式不正确。',
    'uuid'                 => ':attribute 必须是有效的 UUID。',
    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'name'                  => '名称',
        'username'              => '用户名',
        'email'                 => '邮箱',
        'first_name'            => '名',
        'last_name'             => '姓',
        'password'              => '密码',
        'password_confirmation' => '确认密码',
        'city'                  => '城市',
        'country'               => '国家',
        'address'               => '地址',
        'phone'                 => '电话',
        'mobile'                => '手机',
        'age'                   => '年龄',
        'sex'                   => '性别',
        'gender'                => '性别',
        'day'                   => '天',
        'month'                 => '月',
        'year'                  => '年',
        'hour'                  => '时',
        'minute'                => '分',
        'second'                => '秒',
        'title'                 => '标题',
        'content'               => '内容',
        'description'           => '描述',
        'excerpt'               => '摘要',
        'date'                  => '日期',
        'time'                  => '时间',
        'available'             => '可用的',
        'size'                  => '大小',
    ],
];
