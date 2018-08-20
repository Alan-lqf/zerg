<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/8/18
 * Time: 17:56
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
    public $code = 401;
    public $msg = 'Token已过期或无效Token';
    public $errorCode = 10001;
}