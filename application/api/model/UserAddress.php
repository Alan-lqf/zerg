<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/8/21
 * Time: 15:10
 */

namespace app\api\model;


class UserAddress extends BaseModel
{
    protected $hidden = ['id', 'delete_time', 'user_id'];
}