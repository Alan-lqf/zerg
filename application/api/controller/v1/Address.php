<?php
/**
 * Created by PhpStorm.
 * User: Alan
 * Date: 2018/8/21
 * Time: 9:58
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\User as UserModel;
use app\api\service\Token as TokenService;
use app\api\validate\AddressNew;
use app\lib\exception\SuccessMessage;
use app\lib\exception\UserException;

class Address extends BaseController
{

    protected $beforeActionList = [
        'checkPrimaryScope' => ['only' => 'createOrUpdateAddress']
    ];

    public function createOrUpdateAddress()
    {
//        (new AddressNew())->goCheck();
        $validate = new AddressNew();
        $validate->goCheck();
        //根据Token获取uid
        //根据uid来查找用户数据，判断用户是否存在，不存在则抛出异常
        //获取用户从客户端提交来的地址信息
        //根据用户地址信息是否存在，从而判断是添加地址还是更新地址

        $uid = TokenService::getCurrentUid();
        $user = UserModel::get($uid);
        if (!$user){
            throw new UserException();
        }

        $dataArray = $validate->getDataByRule(input('post.'));

        $userAddress = $user->address;

        if (!$userAddress){
            //通过模型的关联模型新增或更新数据（另一种是用Model::create）
            $user->address()->save($dataArray);
        }else{
            $user->address->save($dataArray);
        }
//        return $user;
        return json(new SuccessMessage(), 201);
    }
}