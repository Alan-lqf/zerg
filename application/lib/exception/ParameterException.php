<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/7/3
 * Time: 10:57
 */

namespace app\lib\exception;


class ParameterException extends BaseException
{
    public $code = 400;
    public $msg = '参数错误';
    public $errorCode = 10000;
}