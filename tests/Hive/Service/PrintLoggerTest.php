<?php
declare(strict_types=1);

namespace Tests\Hive\Service;

use Hive\Service\PrintLogger;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class PrintLoggerTest extends TestCase
{
    /** @var PrintLogger */
    private $logger;

    public function setUp(): void
    {
        $this->logger = new PrintLogger();
    }

    /**
     * @test
     */
    public function can_print_info_message(): void
    {
        $this->expectOutputString('info'.PHP_EOL);
        $this->logger->info('info');
    }

    /**
     * @test
     */
    public function can_print_alert_message(): void
    {
        $this->expectOutputString('alert'.PHP_EOL);
        $this->logger->alert('alert');
    }

    /**
     * @test
     */
    public function can_print_critical_message(): void
    {
        $this->expectOutputString('critical'.PHP_EOL);
        $this->logger->critical('critical');
    }

    /**
     * @test
     */
    public function can_print_debug_message(): void
    {
        $this->expectOutputString('debug'.PHP_EOL);
        $this->logger->debug('debug');
    }

    /**
     * @test
     */
    public function can_print_error_message(): void
    {
        $this->expectOutputString('error'.PHP_EOL);
        $this->logger->error('error');
    }

    /**
     * @test
     */
    public function can_print_notice_message(): void
    {
        $this->expectOutputString('notice'.PHP_EOL);
        $this->logger->notice('notice');
    }

    /**
     * @test
     */
    public function can_print_emergency_message(): void
    {
        $this->expectOutputString('emergency'.PHP_EOL);
        $this->logger->emergency('emergency');
    }

    /**
     * @test
     */
    public function can_print_warning_message(): void
    {
        $this->expectOutputString('warning'.PHP_EOL);
        $this->logger->warning('warning');
    }

    /**
     * @test
     */
    public function can_print_log_message(): void
    {
        $this->expectOutputString('log'.PHP_EOL);
        $this->logger->log('warning', 'log');
    }

    /**
     * @test
     */
    public function cannot_print_log_message_with_wrong_lvl(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->logger->log('test', 'log');
    }
}
