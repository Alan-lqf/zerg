<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/7/16
 * Time: 10:46
 */

namespace app\lib\exception;


class ThemeException extends BaseException
{
    public $code = 404;
    public $msg = '指定的主题不存在，请检查主题ID';
    public $errorCode = 30000;
}