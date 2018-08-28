<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/8/28
 * Time: 10:56
 */

namespace app\lib\enum;


class OrderStatusEnum
{
    //未支付
    const UNPAID = 1;

    //已支付
    const PAID = 2;

    //已发货
    const DELIVERED = 3;

    //已支付，但库存不足
    const PAID_BUT_OUT_OF = 4;

}