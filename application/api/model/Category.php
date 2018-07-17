<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/7/17
 * Time: 20:18
 */

namespace app\api\model;


class Category extends BaseModel
{
    public function img()
    {
        return $this->belongsTo('Image', 'topic_img_id', 'id');
    }
}