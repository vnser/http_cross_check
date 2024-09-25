###
自用一款cross接口地址检测脚本,参数请查看check.php文件<br>
check.php: 
```php
<?php
$url = 'https://zfsc.jishu.sgtimes.cn/index.php/addons/shopro/index/init';
$origin = 'http://172.27.19.15:3000';

checkRequest('OPTIONS', $url, $origin);
checkRequest('GET', $url, $origin);

```
```
D:\phpstudy_pro\Extensions\php\php7.4.3nts\php.exe E:\cors_check\cehck.php
#######################################################
验证方法：OPTIONS 
接口URL：https://zfsc.jishu.sgtimes.cn/index.php/addons/shopro/index/init
CROSS验证HOST：http://172.27.19.15:3000
响应码验证: 响应码正确(200)
响应允许域名验证：允许跨域(http://172.27.19.15:3000)
响应允许请求头验证：content-type,platform => 允许
Access-Control-Allow-Origin: *
----------------------------------
响应头：
HTTP/1.1 200 OK
Server: nginx
Date: Wed, 25 Sep 2024 05:00:53 GMT
Content-Type: text/html; charset=UTF-8
Connection: close
Vary: Accept-Encoding
access-control-allow-credentials: True
Access-Control-Allow-Origin: *
Access-Control-Allow-Methods: GET,PUT,POST,DELETE,PATCH,OPTIONS
Access-Control-Allow-Headers: *
Strict-Transport-Security: max-age=31536000
----------------------------------
响应内容：


#######################################################
验证方法：GET 
接口URL：https://zfsc.jishu.sgtimes.cn/index.php/addons/shopro/index/init
CROSS验证HOST：http://172.27.19.15:3000
响应码验证: 响应码正确(200)
响应允许域名验证：允许跨域(http://172.27.19.15:3000)
响应允许请求头验证：content-type,platform => 允许
Access-Control-Allow-Origin: *
----------------------------------
响应头：
HTTP/1.1 200 OK
Server: nginx
Date: Wed, 25 Sep 2024 05:00:53 GMT
Content-Type: application/json; charset=utf-8
Connection: close
Vary: Accept-Encoding
access-control-allow-credentials: True
Access-Control-Allow-Origin: *
Access-Control-Allow-Methods: GET,PUT,POST,DELETE,PATCH,OPTIONS
Access-Control-Allow-Headers: *
Strict-Transport-Security: max-age=31536000
----------------------------------
响应内容：
{"code":0,"msg":"暂不支持该平台,请前往商城配置启用对应平台","time":"1727240453","data":null}


Process finished with exit code 0


```