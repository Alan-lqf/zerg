<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/7/8
 * Time: 14:40
 */

namespace app\api\validate;


class IDCollection extends BaseValidate
{
    protected $rule = [
        'ids' => 'require|checkIDs'
    ];

    protected $message = [
        'ids' => 'ids参数必须是以逗号分割的多个正整数'
    ];

    protected function checkIDs($value)
    {
        $values = explode(',', $value);//转换为数组
        if (empty($values)){
            return false;
        }

        foreach ($values as $id){
            if (!$this->isPositiveInteger($id)){
                return false;
            }
        }

        return true;
    }
}