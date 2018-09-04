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

    public static function getSummaryByUser($uid, $page=1, $size=15)
    {
        $pagingData = self::where('user_id', '=', $uid)
            ->order('create_time', 'desc')
            ->paginate($size, true, ['page' => $page]);
        return $pagingData;
    }

    public static function getSummaryByPage($page=1, $size=20)
    {
        $pagingData = self::order('create_time', 'desc')
            ->paginate($size, true, ['page' => $page]);
        return $pagingData;
    }

    public function products()
    {
        return $this->belongsToMany('Product', 'order_product', 'product_id', 'order_id');
    }
}