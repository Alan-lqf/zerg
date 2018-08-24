<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/8/24
 * Time: 10:59
 */

namespace app\lib\exception;


class OrderException extends BaseException
{
    public $code = 404;
    public $msg = '订单不存在，请检查ID';
    public $errorCode = 80000;
}