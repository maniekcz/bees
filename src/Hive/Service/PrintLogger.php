<?php
declare(strict_types=1);

namespace Hive\Service;

use InvalidArgumentException;
use Psr\Log\LoggerInterface;

class PrintLogger implements LoggerInterface
{
    /** @inheritDoc */
    public function emergency($message, array $context = []): void
    {
        print($message . PHP_EOL);
    }

    /** @inheritDoc */
    public function alert($message, array $context = []): void
    {
        print($message . PHP_EOL);
    }

    /** @inheritDoc */
    public function critical($message, array $context = []): void
    {
        print($message . PHP_EOL);
    }

    /** @inheritDoc */
    public function error($message, array $context = []): void
    {
        print($message . PHP_EOL);
    }

    /** @inheritDoc */
    public function warning($message, array $context = []): void
    {
        print($message . PHP_EOL);
    }

    /** @inheritDoc */
    public function notice($message, array $context = []): void
    {
        print($message . PHP_EOL);
    }

    /** @inheritDoc */
    public function info($message, array $context = []): void
    {
        print($message . PHP_EOL);
    }

    /** @inheritDoc */
    public function debug($message, array $context = []): void
    {
        print($message . PHP_EOL);
    }

    /**
     * @param mixed $level
     * @param string $message
     * @param array $context
     */
    public function log($level, $message, array $context = []): void
    {
        if (!method_exists(__CLASS__, $level)) {
            throw new InvalidArgumentException();
        }
        $this->$level($message);
    }
}
