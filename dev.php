<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-01-01
 * Time: 20:06
 */

return [
  'SERVER_NAME' => "EasySwoole",
  'MAIN_SERVER' => [
    'LISTEN_ADDRESS' => '0.0.0.0',
    'PORT'           => 9501,
    'SERVER_TYPE'    => EASYSWOOLE_WEB_SOCKET_SERVER,
      //可选为 EASYSWOOLE_SERVER  EASYSWOOLE_WEB_SERVER EASYSWOOLE_WEB_SOCKET_SERVER,EASYSWOOLE_REDIS_SERVER
    'SOCK_TYPE'      => SWOOLE_TCP,
    'RUN_MODEL'      => SWOOLE_PROCESS,
    'SETTING'        => [
      'worker_num'    => 8,
        //'task_worker_num'       => 8,
      'reload_async'  => true,
        //'task_enable_coroutine' => true,
      'max_wait_time' => 3,
    ],
    'TASK '          => ['workerNum' => 4, 'maxRunningNum' => 128, 'timeout' => 15],
  ],
  'TEMP_DIR'    => '/tmp/',
  'LOG_DIR'     => null,
  'PHAR'        => [
    'EXCLUDE' => ['.idea', 'Log', 'Temp', 'easyswoole', 'easyswoole.install'],
  ],


  'MYSQL' => [
    'host'          => '192.168.110.200',//防止报错,就不切换数据库了
    'port'          => '3306',
    'user'          => 'root',//数据库用户名
    'password'      => '5ur2pK8WZQdy2-hDZ2xw81dBGysrlxPj',//数据库密码
    'database'      => 'auto_report',//数据库
    'timeout'       => '5',
    'charset'       => 'utf8',
    'POOL_MAX_NUM'  => '6',
    'POOL_TIME_OUT' => '0.1',
  ],


  'MYSQL_ALL' => [
    'host'          => '192.168.110.200',//防止报错,就不切换数据库了
    'port'          => '3306',
    'user'          => 'root',//数据库用户名
    'password'      => '5ur2pK8WZQdy2-hDZ2xw81dBGysrlxPj',//数据库密码
    'database'      => 'crm_service',//数据库
    'timeout'       => '5',
    'charset'       => 'utf8',
    'POOL_MAX_NUM'  => '6',
    'POOL_TIME_OUT' => '0.1',
  ],

    /*################ REDIS CONFIG ##################*/
  'REDIS'     => [
    'host'          => '127.0.0.1',
    'port'          => '6379',
    'auth'          => '',
    'POOL_MAX_NUM'  => '6',
    'POOL_TIME_OUT' => '0.1',
  ],


  'MONGO' => ['host' => '192.168.110.200', 'POOL_MAX_NUM' => '6',],

  'FAST_CACHE' => [//fastCache组件
    'PROCESS_NUM' => 1//进程数,大于0才开启
  ],
];
