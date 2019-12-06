<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/10/26
 * Time: 7:23 PM
 */

namespace App\Utility\Pool;


use EasySwoole\Component\Pool\AbstractPool;
use EasySwoole\EasySwoole\Config;

class MongoPool extends AbstractPool
{
    protected function createObject()
    {
        /*
        // TODO: Implement createObject() method.
        $conf = Config::getInstance()->getConf('MONGO');


        $uri    = "mongodb://192.168.110.200:27017";
        //$client = new \MongoDB\Client($uri);
        $client = $mongo = new MongoDB\Driver\Manager($uri);

        return $client;
        */
        $uri    = "mongodb://192.168.110.200:27017";
        $client = new \MongoDB\Driver\Manager($uri);
        return $client;
    }
}