<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/7/17
 * Time: 17:29
 */

namespace app\api\controller\v1;


use app\api\validate\Count;
use app\api\model\Product as ProductModel;
use app\lib\exception\ProductException;

class Product
{
    public function getRecent($count = 15)
    {
        (new Count())->goCheck();
        $products = ProductModel::getMostRecent($count);
        if ($products->isEmpty()){
            throw new ProductException();
        }
        $collection = collection($products);
        $products = $collection->hidden(['summary']);
        return $products;
    }
}