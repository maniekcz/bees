<?php
declare(strict_types=1);

namespace Tests\Hive\Service;

use Psr\Log\LoggerInterface;

class InMemoryLogger implements LoggerInterface
{
    /** @var array */
    private $logs = [];

    /** @inheritDoc */
    public function emergency($message, array $context = [])
    {
        $this->logs[] = ['emergency' => $message];
    }

    /** @inheritDoc */
    public function alert($message, array $context = [])
    {
        $this->logs[] = ['alert' => $message];
    }

    /** @inheritDoc */
    public function critical($message, array $context = [])
    {
        $this->logs[] = ['critical' => $message];
    }

    /** @inheritDoc */
    public function error($message, array $context = [])
    {
        $this->logs[] = ['error' => $message];
    }

    /** @inheritDoc */
    public function warning($message, array $context = [])
    {
        $this->logs[] = ['warning' => $message];
    }

    /** @inheritDoc */
    public function notice($message, array $context = [])
    {
        $this->logs[] = ['notice' => $message];
    }

    /** @inheritDoc */
    public function info($message, array $context = [])
    {
        $this->logs[] = ['info' => $message];
    }

    /** @inheritDoc */
    public function debug($message, array $context = [])
    {
        $this->logs[] = ['debug' => $message];
    }

    /** @inheritDoc */
    public function log($level, $message, array $context = [])
    {
        $this->logs[] = ['log' => $message];
    }

    public function logs(): array
    {
        return $this->logs;
    }
}
