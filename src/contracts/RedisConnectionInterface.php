<?php

namespace Contracts;

interface RedisConnectionInterface
{
    /**
     * 实例化
     * @param $db 连接池
     * @return mixed
     */
    public function getConn($db = 0);
}