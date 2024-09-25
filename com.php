<?php

function parseHeader($response)
{
    // 分割响应头和响应体
    list($headers, $body) = explode("\r\n\r\n", $response, 2);

// 解析响应头
    $headersArray = [];
    $headersLines = explode("\r\n", $headers);
    foreach ($headersLines as $line) {
        if (preg_match('/HTTP\/\d\.\d (\d{3}) (\w+)/', $line, $matches)) {
            // 状态行
            $status = $matches[1];
            $reasonPhrase = $matches[2];
            $headersArray['http_status'] = $status;
            $headersArray['http_status_text'] = $reasonPhrase;
        } else {
            // 其他响应头
            list($key, $value) = explode(': ', $line, 2);
            $headersArray[strtolower($key)] = $value;
        }
    }
    return $headersArray;
}

// 定义 ANSI 转义序列
define('ANSI_RED', "\033[31m");
define('ANSI_GREEN', "\033[32m");
define('ANSI_RESET', "\033[0m");

/**
 * 打印成功消息（绿色）
 *
 * @param string $message 成功消息
 */
function success($message) {
    return ANSI_GREEN . $message . ANSI_RESET ;
}

/**
 * 打印错误消息（红色）
 *
 * @param string $message 错误消息
 */
function error($message) {
    return ANSI_RED . $message . ANSI_RESET ;
}
function checkRequest($method, $url, $origin)
{
    $info = parse_url($url);
//print_r($info);
    $accessControlRequestHeaders = 'content-type,platform';
    $options = array(
        'http' => array(
            'method' => $method,
            'header' => "Origin: {$origin}\r\nContent-type: application/x-www-form-urlencoded\r\naccess-control-request-headers: {$accessControlRequestHeaders}"
        )
    );
    $context = stream_context_create($options);
// 发送请求并获取响应
    $response = @file_get_contents($url, false, $context);

//http_parse_headers();
    $header = (parseHeader(join("\r\n", $http_response_header)));
//    print_r($header);
// 输出响应头
//header('Content-Type: text/plain; charset=utf-8');
    echo "#######################################################\n";
    echo "验证方法：{$method} \n";
    echo "接口URL：{$url}\n";
    echo "CROSS验证HOST：{$origin}\n";
    /*    if ($method === 'OPTIONS'){
            echo "OPTIONS请求验证：";
            echo $response == '' ?success( '响应内容正确(空)') : error("响应body不为空：{$response}");
            echo "\n";
        }*/
    echo "响应码验证: ".($header['http_status'] >= 200 && $header['http_status'] <= 299 ? success("响应码正确({$header['http_status']})") : error("响应码不正确({$header['http_status']})"));
    echo "\n";
    $accessControlAllowOrigin = $header['access-control-allow-origin'];

    echo "响应允许域名验证：";
    echo in_array($accessControlAllowOrigin, [$origin, "*"]) ? success("允许跨域({$origin})") : error("不允许跨域");
    echo "\r\n";
    $repAccessControlAllowHeaders = $header['access-control-allow-headers'];
    echo "响应允许请求头验证：{$accessControlRequestHeaders} => ";
    echo in_array($repAccessControlAllowHeaders, [$accessControlRequestHeaders, "*"]) ? success("允许") : error("未通过（{$repAccessControlAllowHeaders}）");
    echo "\r\n";
    echo "Access-Control-Allow-Origin: {$accessControlAllowOrigin}";
    echo "\n";
    /*  echo "----------------------------------\n";
      echo "请求头：\n";
      print_r($options['http']);*/
    echo "----------------------------------\n";
    echo "响应头：\n";
    print_r(join("\r\n",$http_response_header));
    echo "\n";
    echo "----------------------------------\n";
    echo "响应内容：\n{$response}\n";
    echo "\n";
}
