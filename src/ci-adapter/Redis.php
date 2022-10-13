<?php

namespace CiAdapter;

use Contracts\RedisConnectionInterface;

class Redis implements RedisConnectionInterface
{
    // 句柄
    protected $handler = NULL;

    // 配置
    protected $options = [
        'host' => RedisHost,    // redis host地址
        'port' => RedisPort,    // 端口地址
        'password' => RedisPass,    // 密码
        'db' => 0,  // 默认db
        'timeout' => 3, // 默认链接失效时间
        'expire' => 3600,   // 默认缓存失效时间
        'singleKeyMaxNum' => 500,   // 默认单个key最大数据个数
        'persistent' => false,  // 持久化 false
        'prefix' => 'x7:',  //默认前缀
    ];


    /**
     * 获取redis链接
     * @param $db
     * @return mixed|void
     */
    public function getConn($db = 0)
    {
        $ci = & get_instance();
        $redis = $ci->config->item('redis_default');
        var_dump($redis);die;
//        $this->handler = new \Redis();
//        $this->handler->connect($this->options['host'], $this->options);
//        $this->handler->auth($this->options['password']);
//        if ($db != 0) {
//            $this->handler->select($db);
//        } else {
//            $this->handler->select($this->options['db']);
//        }
    }
}