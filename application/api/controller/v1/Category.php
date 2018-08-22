<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/7/17
 * Time: 20:18
 */

namespace app\api\controller\v1;

use app\api\model\Category as CategoryModel;

class Category
{
    protected $hidden = ['create_time', 'update_time', 'delete_time'];

    public function getAllCategories()
    {

//        $categories = CategoryModel::with('img')->select();
        $categories = CategoryModel::all([], 'img');
        if ($categories->isEmpty()){
            throw new CagetoryExeption();
        }
        return $categories;
    }
}