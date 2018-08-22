<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/7/17
 * Time: 17:23
 */

namespace app\api\validate;


class Count extends BaseValidate
{
    protected $rule = [
        'count' => 'isPositiveInteger|between:1,15'
    ];
}