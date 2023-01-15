<?php

namespace App\Service;

class AppLogger
{
    const TYPE_LOG4PHP = 'log4php';

    private $loggerProxy;

    public function __construct($type = self::TYPE_LOG4PHP)
    {
        // 使用代理模式访问不同的日志对象
        $this->loggerProxy = new LoggerProxy($type);
    }

    public function info($message = '')
    {
        $this->loggerProxy->write(__FUNCTION__, $message);
    }

    public function debug($message = '')
    {
        $this->loggerProxy->write(__FUNCTION__, $message);
    }

    public function error($message = '')
    {
        $this->loggerProxy->write(__FUNCTION__, $message);
    }
}