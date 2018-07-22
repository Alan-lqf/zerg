<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/7/22
 * Time: 9:49
 */

namespace app\api\controller\v1;

use UserToken;
use app\api\validate\TokenGet;

class Token
{
    public function getToken($code = '')
    {
        (new TokenGet())->goCheck();
        $ut = new UserToken();
        $token = $ut->get($code);
        return $token;
    }
}