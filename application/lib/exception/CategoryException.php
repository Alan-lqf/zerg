<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/7/17
 * Time: 20:28
 */

namespace app\lib\exception;


class CategoryException
{
    public $code = 404;
    public $msg = '指定类目不存在，请检查参数';
    public $errorCode = 50000;
}