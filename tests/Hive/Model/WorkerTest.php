<?php
declare(strict_types=1);

namespace Tests\Hive\Model;

use Hive\Exception\BeeAlreadyDead;
use Hive\Model\Worker;
use PHPUnit\Framework\TestCase;
use Tests\ReflectionTrait;

class WorkerTest extends TestCase
{
    use ReflectionTrait;

    /** @var Worker  */
    protected $bee;

    public function setUp(): void
    {
        $this->bee = Worker::create();
    }

    /**
     * @test
     */
    public function worker_can_be_hit_once(): void
    {
        $this->bee->hit();
        $this->assertEquals(Worker::LIFESPAN - Worker::DAMAGE, $this->bee->lifespan());
    }

    /**
     * @test
     */
    public function worker_can_be_hit_twice(): void
    {
        $this->bee->hit();
        $this->bee->hit();
        $this->assertEquals(Worker::LIFESPAN - Worker::DAMAGE - Worker::DAMAGE, $this->bee->lifespan());
    }

    /**
     * @test
     */
    public function worker_can_be_killed(): void
    {
        $this->setPrivateProperty($this->bee, 'lifespan', Worker::DAMAGE);
        $this->bee->hit();
        $this->assertTrue($this->bee->isDead());
    }

    /**
     * @test
     */
    public function dead_worker_cannot_be_hit(): void
    {
        $this->setPrivateProperty($this->bee, 'lifespan', 0);
        $this->expectException(BeeAlreadyDead::class);
        $this->bee->hit();
    }
}
