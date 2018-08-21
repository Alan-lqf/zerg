<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/6/27
 * Time: 9:52
 */

namespace app\api\validate;


use app\lib\exception\ParameterException;
use think\Exception;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck()
    {
//        todo 为什么不能用依赖注入 Request $request
        // 可以用，在Banner控制器里

        $request = Request::instance();
        $params = $request->param();
//        $params = ['id' => $id];
        $result = $this->batch()->check($params);

        if (!$result){
            $e = new ParameterException();
            $e->msg = $this->error;
            $e->errorCode = 10002;
            throw $e;
//            $error = $this->error;
//            throw new Exception($error);
        }
        else{
            return true;
        }
    }

    protected function isPositiveInteger($value, $rule='', $data='', $field=''){
        if(is_numeric($value) && is_int($value + 0) && ($value + 0) > 0){
            return true;
        }
        else{
            return false;
        }
    }

    protected function isMobile($value){
        $rule = '^1(3|4|5|7|8)[0-9]\d{8}$^';
        $result = preg_match($rule, $value);
        if ($result){
            return true;
        }else{
            return false;
        }
    }

    protected function isNotEmpty($value, $rule='', $data='', $field=''){
        if (empty($value)){
            return false;
        }else{
            return true;
        }
    }

    //获取指定参数
    public function getDataByRule($arrays)
    {
        if (array_key_exists('user_id', $arrays) | array_key_exists('uid', $arrays)){
            throw new ParameterException([
                'msg' => '参数中包含有非法的参数名user_id或uid'
            ]);
            $newArray = [];
            foreach ($this->rule as $key => $value){
                $newArray[$key] = $arrays[$key];
            }
            return $newArray;
        }
    }
}