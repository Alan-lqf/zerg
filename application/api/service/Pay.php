<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/8/27
 * Time: 17:13
 */

namespace app\api\service;


use think\Exception;

class Pay
{
    private $orderID;
    private $orderNO;
    
    function __construct($orderID)
    {
        if (!$orderID){
            throw new Exception('订单号不允许为NULL');
        }
        $this->orderID = $orderID;
    }

    public function pay()
    {
        
    }
}