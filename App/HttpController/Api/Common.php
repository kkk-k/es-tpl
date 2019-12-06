<?php
namespace App\HttpController\Api;

use App\HttpController\Api\Base;
use EasySwoole\Component\Di;
use App\Lib\Redis\Redis;
use EasySwoole\Http\Message\Status;
use EasySwoole\FastCache\Cache;
use App\Model\Mongo\MongoIid;


use App\Utility\Pool\RedisPool;
use App\Utility\Pool\MongoPool;
use think\facade\App;

/**
 * 
 * Class Index. 
 * @package App\HttpController
 */
class Common extends Base
{


    //公共控制器，提供免鉴权方法

    public function login() {

    }





}
