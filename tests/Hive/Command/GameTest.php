<?php
declare(strict_types=1);

namespace Tests\Hive\Command;

use Hive\Command\Game;
use Hive\Exception\GameOverException;
use Hive\Model\Hive;
use Hive\Model\Queen;
use Hive\Model\Worker;
use Hive\Repository\InMemoryHiveRepository;
use Tests\Hive\Service\InMemoryLogger;
use PHPUnit\Framework\TestCase;
use Tests\Hive\Service\FirstBeeProvider;
use Hive\Service\RandomBeeProvider;
use Tests\ReflectionTrait;

class GameTest extends TestCase
{
    use ReflectionTrait;

    /** @var Hive */
    private $hive;

    /** @var InMemoryLogger */
    private $logger;

    /** @var Game */
    private $game;

    public function setUp(): void
    {
        $this->hive = Hive::create(new RandomBeeProvider());
        $this->logger = new InMemoryLogger();
        $this->game = new Game(
            new InMemoryHiveRepository($this->hive),
            $this->logger
        );
    }

    /**
     * @test
     */
    public function can_display_message_after_hit(): void
    {
        $bee = Queen::create();
        $this->hive->addBee($bee);
        $this->game->run();
        $logs = $this->logger->logs();
        $this->assertCount(1, $logs);
        $this->assertEquals(sprintf('Direct Hit. You took %s hit points from a %s bee', $bee->damage(), $bee->name()), $logs[0]['info']);
    }

    /**
     * @test
     */
    public function can_display_messages_after_queen_die(): void
    {
        $queen = Queen::create();
        $this->setPrivateProperty($queen, 'lifespan', Queen::DAMAGE);
        $this->hive->addBee($queen);
        $this->expectException(GameOverException::class);
        try {
            $this->game->run();
        } finally {
            $logs = $this->logger->logs();
            $this->assertCount(2, $logs);
            $this->assertEquals(sprintf('Direct Hit. You took %s hit points from a %s bee', $queen->damage(), $queen->name()), $logs[0]['info']);
            $this->assertEquals('Left 0 hints', $logs[1]['info']);
        }
    }

    /**
     * @test
     */
    public function can_display_messages_when_last_bee_die(): void
    {
        $bee = Worker::create();
        $this->setPrivateProperty($bee, 'lifespan', 0);
        $this->hive->addBee($bee);
        $this->expectException(GameOverException::class);
        try {
            $this->game->run();
        } finally {
            $logs = $this->logger->logs();
            $this->assertCount(1, $logs);
            $this->assertEquals('Left 0 hints', $logs[0]['info']);
        }
    }

    /**
     * @test
     */
    public function can_display_messages_with_hints_after_queen_die(): void
    {
        $this->hive = Hive::create(new FirstBeeProvider());
        $this->game = new Game(
            new InMemoryHiveRepository($this->hive),
            $this->logger
        );
        $queen = Queen::create();
        $this->setPrivateProperty($queen, 'lifespan', Queen::DAMAGE);
        $this->hive->addBee($queen);
        $worker = Worker::create();
        $this->hive->addBee($worker);
        $this->expectException(GameOverException::class);
        try {
            $this->game->run();
        } finally {
            $logs = $this->logger->logs();
            $this->assertCount(2, $logs);
            $this->assertEquals(sprintf('Direct Hit. You took %s hit points from a %s bee', $queen->damage(), $queen->name()), $logs[0]['info']);
            $this->assertEquals(sprintf('Left %s hints', Worker::LIFESPAN), $logs[1]['info']);
        }
    }
}
