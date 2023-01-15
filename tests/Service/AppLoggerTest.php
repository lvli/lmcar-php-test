<?php

namespace Test\Service;

use PHPUnit\Framework\TestCase;
use App\Service\AppLogger;

/**
 * Class ProductHandlerTest
 */
class AppLoggerTest extends TestCase
{
    const THINK_LOG_PATH = './logs/lmcar_cli.log';

    public function testInfoLog()
    {
        $logger = new AppLogger('log4php');
        $this->expectOutputString("INFO - This is info log message\n");
        $logger->info('This is info log message');
    }

    public function testInfoThinkLog()
    {
        $logger = new AppLogger('think-log');
        $logger->info('This is info think log message');
        $result = file(self::THINK_LOG_PATH);
        $line = $result[count($result)-1];
        $this->assertEquals("[][info]:THIS IS INFO THINK LOG MESSAGE\n", $line);
    }

    public function testDebugLog()
    {
        $logger = new AppLogger('log4php');
        $this->expectOutputString("DEBUG - This is debug log message\n");
        $logger->debug('This is debug log message');
    }

    public function testDebugThinkLog()
    {
        $logger = new AppLogger('think-log');
        $logger->debug('This is debug think log message');
        $result = file(self::THINK_LOG_PATH);
        $line = $result[count($result)-1];
        $this->assertEquals("[][debug]:THIS IS DEBUG THINK LOG MESSAGE\n", $line);
    }

    public function testErrorLog()
    {
        $logger = new AppLogger('log4php');
        $this->expectOutputString("ERROR - This is error log message\n");
        $logger->error('This is error log message');
    }

    public function testErrorThinkLog()
    {
        $logger = new AppLogger('think-log');
        $logger->error('This is error think log message');
        $result = file(self::THINK_LOG_PATH);
        $line = $result[count($result)-1];
        $this->assertEquals("[][error]:THIS IS ERROR THINK LOG MESSAGE\n", $line);
    }
}