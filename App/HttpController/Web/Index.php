<?php
/**
 * Created by PhpStorm.
 * User: Double-jin
 * Date: 2019/6/19
 * Email: 605932013@qq.com
 */


namespace App\HttpController\Web;

use App\Model\FriendGroupModel;
use App\Model\GroupMemberModel;
use App\Model\UserModel;
use App\Utility\Pool\RedisObject;
use App\Utility\Pool\RedisPool;

use EasySwoole\Validate\Validate;
use EasySwoole\VerifyCode\Conf;


/**
 * Class Index
 *
 * @package App\HttpController
 */
class Index extends Base
{

    public function test()
    {
        $this->tpRender('test');
    }

    public function home(){
        return $this->tpRender('/index/home');
    }



    public function index()
    {
        $token = $this->request()->getRequestParam('token');

        $RedisPool = RedisPool::defer();
        $user      = $RedisPool->get('User_token_'.$token);

        if (!$user) {
            $this->response()->redirect("/login");
        }
        $user     = json_decode($user, true);
        $hostName = 'ws://es-chat.cc:9501';
        $this->render('index', [
          'server' => $hostName,
          'token'  => $token,
          'user'   => $user,
        ]);
    }


}
