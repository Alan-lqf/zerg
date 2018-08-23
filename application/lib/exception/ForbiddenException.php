<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/8/22
 * Time: 14:42
 */

namespace app\lib\exception;


class ForbiddenException extends BaseException
{
    public $code = 403;
    public $msg = '权限不够';
    public $errorCode = 10001;
}