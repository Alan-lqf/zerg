<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/8/20
 * Time: 10:17
 */

namespace app\api\model;


class ProductProperty extends BaseModel
{
    protected $hidden = ['product_id', 'delete_time', 'id'];
}