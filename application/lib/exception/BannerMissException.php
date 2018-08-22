<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/6/29
 * Time: 20:58
 */

namespace app\lib\exception;


class BannerMissException extends BaseException
{
    public $code = 404;
    public $msg = '请求的Banner不存在';
    public $errorCode = 40000;
}