<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/6/27
 * Time: 9:08
 */

namespace app\api\validate;


use think\Validate;

class TestValidate extends Validate
{
    protected $rule = [
        'name' => 'require|max:6',
        'email' => 'email'
    ];
}