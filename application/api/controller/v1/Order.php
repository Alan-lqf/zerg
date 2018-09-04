<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/8/22
 * Time: 15:23
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\validate\IDMustBePositiveInteger;
use app\api\validate\OrderPlace;
use app\api\service\Token as TokenService;
use app\api\service\Order as OrderService;
use app\api\model\Order as OrderModel;
use app\api\validate\PagingParameter;
use app\lib\exception\OrderException;

class Order extends BaseController
{
    //用户在选择商品后，向API提交包含它所选择商品的相关信息
    //API在接收到信息后，需要检查订单相关商品的库存量
    //有库存，把订单数据存入数据库中， 下单成功了，返回客户端消息，告诉客户端可以支付了
    //调用支付接口，进行支付
    //再次进行库存量检测
    //服务器这边就可以调用微信的支付接口进行支付
    //微信会返回给我们一个支付的结果（异步）
    //成功：也与要进行库存量的检查
    //成功：进行库存量的扣除

    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'placeOrder']
    ];

    public function placeOrder()
    {
        (new OrderPlace())->goCheck();
        $products = input('post.products/a');
        $uid = TokenService::getCurrentUid();

        $order = new OrderService();
        $status = $order->place($uid, $products);
        return $status;
    }

    /**
     * 获取订单详情
     * @param $id
     * @return OrderModel
     * @throws OrderException
     * @throws \app\lib\exception\ParameterException
     * @throws \think\exception\DbException
     */
    public function getDetail($id)
    {
        (new IDMustBePositiveInteger())->goCheck();
        $orderDetail = OrderModel::get($id);
        if (!$orderDetail)
        {
            throw new OrderException();
        }
        return $orderDetail
            ->hidden(['prepay_id']);
    }

    /**
     * 根据用户id分页获取订单列表（简要信息）
     * @param int $page
     * @param int $size
     * @return array
     * @throws \app\lib\exception\ParameterException
     */
    public function getSummaryByUser($page=1, $size=15)
    {
        (new PagingParameter())->goCheck();
        $uid = TokenService::getCurrentUid();
        $pagingOrders = OrderModel::getSummaryByUser($uid, $page, $size);
        if ($pagingOrders->isEmpty())
        {
            return [
                'current_page' => $pagingOrders->currentPage(),
                'data' => []
            ];
        }
        $data = $pagingOrders->hidden('snap_items', 'snap_address')
            ->toArray();
        return [
            'current_page' => $pagingOrders->currentPage(),
            'data' => $data
        ];
    }

    public function getSummary($page=1, $size=20)
    {
        (new PagingParameter())->goCheck();
        $pagingOrders = OrderModel::getSummaryByPage($page, $size);
        if (!$pagingOrders)
        {
            return [
                'current_page' => $pagingOrders->currentPage(),
                'data' => []
            ];
        }
        $data = $pagingOrders->hidden(['snap_items', 'snap_address'])
            ->toArray();
        return [
            'current_page' => $pagingOrders->currentPage(),
            'data' => $data
        ];
    }
}