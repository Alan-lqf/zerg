<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/7/8
 * Time: 14:13
 */

namespace app\api\controller\v1;


use app\api\validate\IDCollection;
use app\api\model\Theme as ThemeModel;
use app\lib\exception\ThemeException;

class Theme
{
    /**
     * @url /theme?ids=id1,id2,id3,...
     * @return 一组theme模型
     */
    public function getSimpleList($ids='')
    {
        (new IDCollection())->goCheck();
        $ids = explode(',', $ids);
        $result = ThemeModel::getThemeById($ids);
        if (!$result){
            throw new ThemeException();
        }
        return $result;

    }

}