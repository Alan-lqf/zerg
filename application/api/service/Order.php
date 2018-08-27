<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/8/23
 * Time: 17:06
 */

namespace app\api\service;


use app\api\model\OrderProduct;
use app\api\model\Product;
use app\api\model\UserAddress;
use app\lib\exception\OrderException;
use app\lib\exception\UserException;
use app\api\model\Order as OrderModel;
use think\Db;
use think\Exception;

class Order
{
    //订单的商品列表，也就是客户端传过来的products参数
    protected $oProducts;
    //真实的商品信息（包括库存量）
    protected $products;
    protected $uid;

    //下单
    public function place($uid, $oProducts)
    {
        //oProducts和Products做对比
        //Products从数据库中查询出来
        $this->oProducts = $oProducts;
        $this->products = $this->getProductsByOrder($oProducts);
        $this->uid = $uid;
        $status = $this->getOrderStatus();
        if (!$status['pass']){
            $status['order_id'] = -1;
            return $status;
        }

        //开始创建订单
        $orderSnap = $this->snapOrder($status);
        $order = $this->createOrder($orderSnap);
        $order['pass'] = true;
        return $order;
    }

    //生成订单快照
    private function snapOrder($status){
        $snap = [
            'orderPrice' => 0,
            'totalCount' => 0,
            'pStatus' => [],
            'snapAddress' => null,
            'snapName' => '',
            'snapImg' => ''
        ];

        $snap['orderPrice'] = $status['orderPrice'];
        $snap['totalCount'] = $status['totalCount'];
        $snap['pStatus'] = $status['pStatusArray'];
        $snap['snapAddress'] = json_encode($this->getUserAddress());
        $snap['snapName'] = $this->products[0]['name'];
        $snap['snapImg'] = $this->products[0]['main_img_url'];

        if ($this->products[1]){ //商品多于一个，前端展示为 xxx等
            $snap['snapName'] .= '等';
        }
    }

    private function createOrder($snap){
        Db::startTrans();
        try{
            $orderNo = self::makeOrderNo(); //TODO this-> 与 self:: 见commit链接
            $order = new OrderModel();
            $order->user_id = $this->uid;
            $order->order_no = $orderNo;
            $order->total_price = $snap['orderPrice'];
            $order->total_count = $snap['totalCount'];
            $order->snap_img = $snap['snapImg'];
            $order->snap_name = $snap['snapName'];
            $order->snap_address = $snap['snapAddress'];
            $order->snap_items = json_encode($snap['pStatus']);

            $order->save();  // save 单个  saveAll 数组

            $orderID = $order->id;
            $create_time = $order->create_time;
            foreach ($this->oProducts as &$p){ //要追加 order_id 字段就需要在 $p 前加上 &
                $p['order_id'] = $orderID;
            }
            $orderProduct = new OrderProduct();
            $orderProduct->saveAll($this->oProducts);  // save 单个  saveAll 数组
            Db::commit();
            return [
                'order_no' => $orderNo,
                'order_id' => $orderID,
                'create_time' => $create_time
            ];

        }catch (Exception $ex){
            Db::rollback();
            throw $ex;
        }

    }

    public static function makeOrderNo()
    {
        $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J' );
        $orderSn = $yCode[intval(date('Y'))-2017] - strtoupper(dechex(date('m'))).date('d').substr(time(), -5).substr(microtime(), 2, 5).sprintf('%02d', rand(0,99));
        return $orderSn;
    }

    private function getUserAddress(){
        $userAddress = UserAddress::where('user_id', '=', $this->uid)
            ->find();
        if (!$userAddress){
            throw new UserException([
                'msg' => '用户收货地址不存在，下单失败',
                'errorCode' => 60001
            ]);
        }
        return $userAddress->toArray(); //tips:用模型查出来的是一个对象，需要转换为数组
    }

    //订单信息
    private function getOrderStatus(){
        $status = [
            'pass' => true,
            'totalCount' => 0, //订单总数
            'orderPrice' => 0, //订单总价
            'pStatusArray' => [] //保存订单商品详情
        ];

        foreach ($this->oProducts as $oProduct){
            $pStatus = $this->getProductStatus(
                $oProduct['product_id'], $oProduct['count'], $this->products
            );
            if (!$pStatus['haveStock']){
                $status['pass'] = false;
            }
            $status['totalCount'] += $pStatus['count'];
            $status['orderPrice'] += $pStatus['totalPrice'];
            array_push($status['pStatusArray'], $pStatus);
        }
        return $status;
    }

    //订单里的单个商品信息
    private function getProductStatus($oPID, $oCount, $products){
        $pIndex = -1;
        $pStatus = [
            'id' => null,
            'haveStock' => false,
            'count' => 0,
            'name' => '',
            'totalPrice' => 0
        ];

        for ($i=0; $i<count($products); $i++){
            if ($oPID == $products[$i]['id']){
                $pIndex = $i;

            }
        }

        if ($pIndex == -1){
            //客户端传递的product_id有可能根本不存在
            throw new OrderException([
                'msg' => 'id为'.$oPID.'的商品不存在，订单创建失败'
            ]);
        }else{
            $product = $products[$pIndex];
            $pStatus['id'] = $product['id'];
            $pStatus['name'] = $product['name'];
            $pStatus['count'] = $oCount;
            $pStatus['totalPrice'] = $product['price'] * $oCount;
            if ($product['stock'] - $oCount >= 0){
                $pStatus['haveStock'] = true;
            }
            return $pStatus;
        }

    }

    //根据订单信息查找真实商品的信息
    private function getProductsByOrder($oProducts){
        $oPIDs = [];
        foreach ($oProducts as $item) {
            array_push($oPIDs, $item['product_id']);
        }
        $products = Product::all($oPIDs)
            ->visible('id', 'price', 'stock', 'name', 'main_img_url')
            ->toArray();
        return $products;
    }
}