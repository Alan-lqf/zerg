<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/8/21
 * Time: 10:00
 */

namespace app\api\validate;


class AddressNew extends BaseValidate
{
    protected $rule = [
        'name' => 'require|isNotEmpty',
        'mobile' => 'require|isMobile',
        'province' => 'require|isNotEmpty',
        'city' => 'require|isNotEmpty',
        'country' => 'require|isNotEmpty',
        'detail' => 'require|isNotEmpty'
    ];

}