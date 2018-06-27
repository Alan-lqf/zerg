<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/6/27
 * Time: 9:52
 */

namespace app\api\validate;


use think\Exception;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck()
    {
//        todo 为什么不能用依赖注入 Request $request
        $request = Request::instance();
        $params = $request->param();

        $result = $this->check($params);

        if (!$result){
            $error = $this->error;
            throw new Exception($error);
        }
        else{
            return true;
        }
    }
}