<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/6/25
 * Time: 22:44
 */

namespace app\api\controller\v1;


use app\api\model\Banner as BannerModel;
use app\api\validate\IDMustBePositiveInteger;
use app\lib\exception\BannerMissException;
use think\Exception;


class Banner
{
    /**
     * @param $id
     *
     */
    public function getBanner($id)
    {
        (new IDMustBePositiveInteger())->goCheck();

        $banner = BannerModel::getBannerByID($id);
//        $banner->hidden(['delete_time', 'update_time']);
        if (!$banner){
            throw new BannerMissException();
        }

        return $banner;

    }

}