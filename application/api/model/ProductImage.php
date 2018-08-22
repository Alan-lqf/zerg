<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/8/20
 * Time: 10:14
 */

namespace app\api\model;


class ProductImage extends BaseModel
{
    protected $hidden = ['img_id', 'delete_time', 'product_id'];

    public function imgUrl()
    {
        return $this->belongsTo('Image', 'img_id', 'id');
    }
}