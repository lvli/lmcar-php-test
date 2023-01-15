<?php

namespace Test\App;

use App\App\Demo;
use App\Mock\Util\HttpRequestMock;
use PHPUnit\Framework\TestCase;


class DemoTest extends TestCase
{
    /**
     * 测试foo函数
     * @author lvli
     */
    public function test_foo()
    {
        $logger = \Logger::getLogger('Log');
        $request = new HttpRequestMock();
        $demo = new Demo($logger, $request);
        $result = $demo->foo();
        $this->assertEquals('bar', $result);
    }

    /**
     * 测试获取用户信息
     * @author lvli
     */
    public function test_get_user_info()
    {
        $logger = \Logger::getLogger('Log');
        $request = new HttpRequestMock();
        $demo = new Demo($logger, $request);
        $result = $demo->get_user_info();
        $this->assertEquals([
            'id' => 1,
            'username' => 'hello world',
        ], $result);
    }
}
