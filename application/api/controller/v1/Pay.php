<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/8/27
 * Time: 17:09
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\validate\IDMustBePositiveInteger;

class Pay extends BaseController
{
    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'getPreOrder']
    ];

    public function getPreOrder($id = '')
    {
        (new IDMustBePositiveInteger())->goCheck();
    }
}