<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/8/27
 * Time: 15:48
 */

namespace app\api\model;


class Order extends BaseModel
{
    protected $hidden = ['user_id', 'delete_time', 'update_time'];
}