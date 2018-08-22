<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/6/27
 * Time: 9:30
 */

namespace app\api\validate;



class IDMustBePositiveInteger extends BaseValidate
{
    protected $rule = [
        'id' => 'require|isPositiveInteger',
        'num' => 'in:1,2,3'
    ];

    protected $message = [
        'id' => 'id必须是正整数'
    ];
}