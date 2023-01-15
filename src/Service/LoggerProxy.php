<?php

namespace App\Service;

use think\facade\Log;

/**
 * 通过代理模式访问不同的日志组件
 */
class LoggerProxy
{
    /**
     * 日志类型
     */
    const TYPE_LOG4PHP = 'log4php';
    const TYPE_THINK_LOG = 'think-log';

    /**
     * 当前日志类型
     * @var string
     */
    private $type;

    /**
     * 当前日志对象
     * @var \Logger|Log
     */
    private $logger;

    /**
     * 初始化日志代理对象
     * @param string $type 日志类型 log4php think-log
     * @author lvli
     */
    public function __construct(string $type = self::TYPE_LOG4PHP)
    {
        $this->type = $type;
        if($type == self::TYPE_LOG4PHP) {
            $this->logger = \Logger::getLogger("Log");
        }elseif($type == self::TYPE_THINK_LOG) {
            $this->logger = new Log();
            $this->logger::init([
                'default' => 'file',
                'channels' => [
                    'file' => [
                        'type' => 'file',
                        'path' => './logs/',
                        'single' =>	'lmcar',
                        'time_format' => '',
                        'format' => '[%s][%s]:%s',
                    ],
                ],
            ]);
        }
    }

    /**
     * 记录日志
     * @param string $level 日志级别 debug info error
     * @param string $message 日志内容
     * @author lvli
     */
    public function write(string $level, string $message) :void
    {
        if ($this->type == self::TYPE_LOG4PHP) {
            $this->logger->$level($message);
        } elseif($this->type == self::TYPE_THINK_LOG) {
            $message = strtoupper($message);
            $this->logger::$level($message);
        }
    }
}