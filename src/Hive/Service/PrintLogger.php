<?php
declare(strict_types=1);

namespace Hive\Service;

use Psr\Log\LoggerInterface;

class PrintLogger implements LoggerInterface
{
    public function emergency($message, array $context = []): void
    {
        print($message . PHP_EOL);
    }

    public function alert($message, array $context = []): void
    {
        print($message . PHP_EOL);
    }

    public function critical($message, array $context = []): void
    {
        print($message . PHP_EOL);
    }

    public function error($message, array $context = []): void
    {
        print($message . PHP_EOL);
    }

    public function warning($message, array $context = []): void
    {
        print($message . PHP_EOL);
    }

    public function notice($message, array $context = []): void
    {
        print($message . PHP_EOL);
    }

    public function info($message, array $context = []): void
    {
        print($message . PHP_EOL);
    }

    public function debug($message, array $context = []): void
    {
        print($message . PHP_EOL);
    }

    public function log($level, $message, array $context = []): void
    {
        print($message . PHP_EOL);
    }
}
