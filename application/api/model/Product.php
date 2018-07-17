<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/7/8
 * Time: 14:14
 */

namespace app\api\model;


use app\api\validate\Count;

class Product extends BaseModel
{
    protected $hidden = ['create_time', 'update_time','delete_time', 'category_id', 'pivot', 'from'];


    public function getMainImgUrlAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }

    public static function getMostRecent($count)
    {
        $products = self::limit($count)
            ->order('create_time desc')
            ->select();
        return $products;
    }

}