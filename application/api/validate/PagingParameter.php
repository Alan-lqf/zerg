<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/9/4
 * Time: 16:01
 */

namespace app\api\validate;


class PagingParameter extends BaseValidate
{
    protected $rule = [
        'page' => 'isPositiveInteger',
        'size' => 'isPositiveInteger'
    ];

    protected $massage = [
        'page' => '分页参数必须是正整数',
        'size' => '分页参数必须是正整数'
    ];
}