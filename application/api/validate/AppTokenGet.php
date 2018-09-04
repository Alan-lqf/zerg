<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/9/3
 * Time: 15:52
 */

namespace app\api\validate;


class AppTokenGet extends BaseValidate
{
    protected $rule = [
        'ac' => 'require|isNotEmpty',
        'se' => 'require|isNotEmpty'
    ];
}