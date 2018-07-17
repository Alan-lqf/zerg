<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/7/8
 * Time: 14:14
 */

namespace app\api\model;

use app\api\model\Theme as ThemeModel;


class Theme extends BaseModel
{

    protected $hidden = ['update_time','delete_time', 'topic_img_id', 'head_img_id'];

    public function topicImg()
    {
        /**一对一关系有顺序，Image里没有记录两张表之间的关系
         *如果在model/Image里，用$this->hasOne()
         */
        return $this->belongsTo('Image', 'topic_img_id', 'id');
    }

    public function headImg()
    {
        return $this->belongsTo('Image', 'head_img_id', 'id');
    }

    public static function getThemeById($ids)
    {
        $theme = self::with(['topicImg', 'headImg'])->select($ids);
        return $theme;
    }

    public function products()
    {
        return $this->belongsToMany('Product', 'theme_product', 'product_id', 'theme_id');
    }

    public static function getThemeWithProducts($id)
    {
        $theme = self::with(['products', 'headImg', 'topicImg'])->find($id);
        return $theme;
    }
}