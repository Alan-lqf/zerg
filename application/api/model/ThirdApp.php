<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/9/3
 * Time: 15:59
 */

namespace app\api\model;


class ThirdApp extends BaseModel
{
    public static function check($ac, $se){
        $app = self::where('app_id', '=', $ac)
            ->where('app_secret', '=', $se)
            ->find();
        return $app;
    }
}