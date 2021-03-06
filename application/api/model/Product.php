<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/7/8
 * Time: 14:14
 */

namespace app\api\model;


use app\api\validate\Count;
use app\api\validate\IDMustBePositiveInteger;

class Product extends BaseModel
{
    protected $hidden = ['create_time', 'update_time','delete_time', 'category_id', 'pivot', 'from'];


    public function getMainImgUrlAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }

    public function imgs()
    {
        return $this->hasMany('ProductImage', 'product_id', 'id');
    }

    public function properties()
    {
        return $this->hasMany('ProductProperty', 'product_id', 'id');
    }

    public static function getMostRecent($count)
    {
        $products = self::limit($count)
            ->order('create_time desc')
            ->select();
        return $products;
    }

    public static function getProductsByCategoryID($categoryID)
    {
        $products = self::where('category_id', '=', $categoryID)
            ->select();
        return $products;
    }

    public static function getProductDetail($id)
    {
        $product = self::with([
            'imgs' => function($query){
                $query->with(['imgUrl'])
                    ->order('order', 'asc');
            }
        ])
            ->with(['properties'])
            ->find($id);

        return $product;
    }
}