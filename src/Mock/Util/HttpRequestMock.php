<?php
namespace App\Mock\Util;

use App\Util\HttpRequest;

/**
 * 模拟请求类
 * @author lvli
 */
class HttpRequestMock extends HttpRequest {
    /**
     * 模拟GET请求方法
     * @param string $url 请求地址
     * @return string json格式的请求数据
     * @author lvli
     */
    function get($url)
    {
       return json_encode([
           'error' => 0,
           'data' => [
               'id' => 1,
               'username' => 'hello world',
           ],
       ]);
    }
}