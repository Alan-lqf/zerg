<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/7/22
 * Time: 9:50
 */

namespace app\api\validate;


class TokenGet extends BaseValidate
{
    protected $rule = [
        'code' => 'require|isNotEmpty'
    ];

    protected $message = [
        'code' => '没有code还想获取Token，做梦哦！'
    ];
}