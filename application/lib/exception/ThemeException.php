<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/7/11
 * Time: 11:32
 */

namespace app\lib\exception;


class ThemeException extends BaseException
{
    public $code = 404;
    public $message = '指定主题不存在，请检查主题ID';
    public $errorCode = 30000;
}