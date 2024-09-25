<?php
//require_once 'vendor/autoload.php';
require_once 'com.php';
$url = 'https://zfsc.jishu.sgtimes.cn/index.php/addons/shopro/index/init';
$origin = 'http://172.27.19.15:3000';

checkRequest('OPTIONS', $url, $origin);
checkRequest('GET', $url, $origin);