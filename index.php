<?php

use CiAdapter\Redis;

require "vendor/autoload.php";
$a = (new Redis())->getConn();
var_dump($a);
