<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/8/15
 * Time: 上午10:39
 */

namespace App\HttpController;


use EasySwoole\Http\AbstractInterface\AbstractRouter;
use FastRoute\RouteCollector;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;

class Router extends AbstractRouter
{
    function initialize(RouteCollector $routeCollector)
    {
        $routeCollector->addRoute(['GET'], '/report/home', '/web/index/home');
        $routeCollector->addRoute(['GET', 'POST'], '/report/login', '/web/common/login');
        $routeCollector->addRoute(['GET', 'POST'], '/report/market', '/web/common/data');

        //全局拦截模式
        //$this->setGlobalMode(true);

        //设置错误提示方法
        $this->setMethodNotAllowCallBack(function (Request $request,Response $response){
            $response->write('未找到处理方法');
            return false;//结束此次响应
        });
        $this->setRouterNotFoundCallBack(function (Request $request,Response $response){
            $response->write('未找到路由匹配');
            return 'index';//重定向到index路由
        });

    }
}