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
class Index extends Base
{

    public function index() {

    }

    /**
     * 第一套方案 原始  - 读取 Mysql
     * [lists description]
     * @auth   singwa
     * @return [type] [description]
     */
    public function lists0() {
    
        $condition = [];
        if(!empty($this->params['cat_id'])) {
            $condition['cat_id'] = intval($this->params['cat_id']);
        }
        // 
        // 1 查询 条件 下 count
        // 2 lists 
        // 
        
        try {
            $videoModel = new VideoModel();
            $data = $videoModel->getVideoData($condition, $this->params['page'], $this->params['size']);
        }catch(\Exception $e) {
            // $e->getMessage();
            return $this->writeJson(Status::CODE_BAD_REQUEST, "服务异常");
        }
        
        if(!empty($data['lists'])) {
            foreach($data['lists'] as &$list) {
                //$data['lists'][$k]['create_time'] = date("Ymd H:i:s", $data['lists'][$k]['create_time']);
                $list['create_time'] = date("Ymd H:i:s", $list['create_time']);
                // 00:01:07  
                $list['video_duration'] = gmstrftime("%H:%M:%S", $list['video_duration']);
            }
        }
        return $this->writeJson(Status::CODE_OK, "OK", $data);
    }



    /**
     * 第二套方案 直接读取 静态化 json数据
     * [lists description]
     * @auth   singwa
     * @return [type] [description]
     */
    public function lists() {
        $catId = !empty($this->params['cat_id']) ? intval($this->params['cat_id']) : 0;
        try {
            $videoData = (new VideoCache())->getCache($catId);
        }catch(\Exception $e) {
            return $this->writeJson(Status::CODE_BAD_REQUEST , "请求失败");
        }
        
        $count = count($videoData);

        return $this->writeJson(Status::CODE_OK, "OK", $this->getPagingDatas($count, $videoData)); 
    }

    /**
     * 首页方法
     * @author : evalor <master@evalor.cn>
     */
    public function video()
    {
        ////$a = new abc();
        $video = [
            'id' => 1222,
            'name' => 'imooc',
            'params' => $this->request()->getRequestParam()
            
        ];
        return $this->writeJson(2, 'OK', $video);
        
    }

    public function test11(){

        //$this->redis->set('aa',333);
        RedisPool::defer()->set('aa',333);

        return $this->writeJson(2, 'OK', RedisPool::defer()->get('aa'));
    }

    /**
     * @auth   singwa
     * @date   2018-10-04T22:40:55+0800
     * @return [type]
     */
    public function getVideo() {
        $db = Di::getInstance()->get("MYSQL");
        //$result = $db->where("id", 1)->getOne("video");
        $result = $db->get('video');
        return $this->writeJson(200, 'OK', $result);

    }

    public function mongotest2(){

        $csp = new \EasySwoole\Component\Csp();

        go(function () use($csp){

            for ($i=0;$i<100;$i++){
                $csp->add($i,function (){
                    return $this->xwrq();
                });
            }


        });

        $data = ($csp->exec());




        return $this->writeJson(200, 'OK', $data);
    }


    public function xwrq(){

        $iidModel = new MongoIid();
        $data =  $iidModel->where('_id','66NJWRJU')->select();

        return $data;
    }

    public function mongo(){

        $iidModel = new MongoIid();
        $data1 = $iidModel->select();
        $data2 = $iidModel->select();

        $data = array_merge($data1,$data2);


        return $this->writeJson(200, 'OK', $data);
    }

    public function getVideo2(){

        //$result = $db->where("id", 1)->getOne("video");
        $result= [];

        $db = Di::getInstance()->get("MYSQL2");


        $csp = new \EasySwoole\Component\Csp();

        go(function () use($db,$csp){
            for ($i=0;$i<10;$i++){
                $csp->add($i,function () use($db){
                    //$temp = $db->get('admin');
                    $temp = $this->_getData();
                    return $temp;
                });
            }
        });
        $result = $csp->exec();

        return $this->writeJson(200, 'OK', $result);
    }

    private function _getData(){
        \co::sleep(2);
        return ['a'=>1];
    }

    public function getRedis() {
        ///$redis = new \Redis();
        ////$redis->connect("127.0.0.1", 6379, 5);

        //$redis->set("singwa456", 900);
        //
    
        //$result = Redis::getInstance()->get('singwa');
        //
        $result = Di::getInstance()->get("REDIS")->get('singwa');
        return $this->writeJson(200, 'OK', $result);

    }



}
