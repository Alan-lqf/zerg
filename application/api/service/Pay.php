<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/8/27
 * Time: 17:13
 */

namespace app\api\service;


use app\lib\enum\OrderStatusEnum;
use app\lib\exception\OrderException;
use app\lib\exception\TokenException;
use think\Exception;
use app\api\service\Order as OrderService;
use app\api\model\Order as OrderModel;
use app\api\service\Token as TokenService;
use think\Loader;

//  extend/WxPay/WxPay.Api.php
Loader::import('WxPay.WxPay', EXTEND_PATH, '.Api.php');

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
        //订单号可能根本就不存在
        //订单号已存在，但是，订单号与当前用户不匹配
        //订单可能已支付
        //进行库存量检测
        $this->checkOrderValid();
        $orderService = new OrderService();
        $status = $orderService->checkOrderStock($this->orderID);
        if (!$status){
            return $status;
        }
    }

    private function makeWxPreOrder(){
        //openid
        $openid = TokenService::getCurrentTokenVar('openid');
        if (!$openid){
            throw new TokenException();
        }
        $wxOrderData = new \WxPayUnifiedOrder();
    }

    private function checkOrderValid(){
        $order = OrderModel::where('id', '=', $this->orderID)
            ->find();
        if (!$order){
            throw new OrderException();
        }
        if (!TokenService::isValidOperate($order->user_id)){
            throw new TokenException([
                'msg' => '订单与用户不匹配',
                'errorCode' => 10003
            ]);
        }
        if ($order->status != OrderStatusEnum::UNPAID){
            throw new OrderException([
                'code' => 400,
                'msg' => '订单已经支付过啦',
                'errorCode' => 80003
            ]);
        }
        $this->orderNO = $order->order_no;
        return true;
    }

}