<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/6/25
 * Time: 22:44
 */

namespace app\api\controller\v2;


use app\api\model\Banner as BannerModel;
use app\api\validate\IDMustBePositiveInteger;
use app\lib\exception\BannerMissException;


class Banner
{
    /**
     * @param $id
     *
     */
    public function getBanner($id)
    {
        return "v2";

    }

}