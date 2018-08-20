<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/8/17
 * Time: 10:54
 */

namespace app\api\model;


class User extends BaseModel
{
    public static function getByOpenId($openid)
    {
        $user = self::where('openid','=',$openid)
            ->find();
        return $user;

    }
}