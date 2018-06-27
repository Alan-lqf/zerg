<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/6/25
 * Time: 22:44
 */

namespace app\api\controller\v1;


use app\api\validate\IDMustBePositiveInteger;


class Banner
{
    /**
     * @param $id
     *
     */
    public function getBanner($id)
    {
        (new IDMustBePositiveInteger())->goCheck($id);
        $c = 1;

//        $data = [
//            'id' => $id,
//        ];
//
//
//        $validate = new IDMustBePositiveInteger();
//
//        $result = $validate->batch()->check($data);
//        if ($result){
//
//        }
//        else{
//
//        }
//        var_dump($validate->getError());
    }

}