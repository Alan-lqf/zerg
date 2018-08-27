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
    protected $autoWriteTimestamp = true; //自动写入时间戳
//    protected $createTime = 'create_timeStamp'; 自定义create_time字段名
}