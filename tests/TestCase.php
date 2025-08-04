<?php

declare(strict_types=1);

namespace Phlux\Component\OperatingSystem\Tests;

use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    private static null|LoggerInterface $logger = null;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        if (!self::$logger) {
            self::$logger = new Logger('test');
            self::$logger->pushHandler(new StreamHandler(dirname(__DIR__) . '/var/log/test.log', Level::Debug));
        }
    }

    public function getLogger(): LoggerInterface
    {
        if (self::$logger === null) {
            throw new \RuntimeException('Logger not initialized');
        }

        return self::$logger;
    }
}
