<?php
declare(strict_types=1);

namespace Tests\Hive\Model;

use Hive\Exception\BeeAlreadyDead;
use Hive\Model\Drone;
use PHPUnit\Framework\TestCase;
use Tests\ReflectionTrait;

class DroneTest extends TestCase
{
    use ReflectionTrait;

    /** @var Drone  */
    protected $bee;

    public function setUp(): void
    {
        $this->bee = Drone::create();
    }

    /**
     * @test
     */
    public function drone_can_be_hit_once(): void
    {
        $this->bee->hit();
        $this->assertEquals(Drone::LIFESPAN - Drone::DAMAGE, $this->bee->lifespan());
    }

    /**
     * @test
     */
    public function drone_can_be_hit_twice(): void
    {
        $this->bee->hit();
        $this->bee->hit();
        $this->assertEquals(Drone::LIFESPAN - Drone::DAMAGE - Drone::DAMAGE, $this->bee->lifespan());
    }

    /**
     * @test
     */
    public function drone_can_be_killed(): void
    {
        $this->setPrivateProperty($this->bee, 'lifespan', Drone::DAMAGE);
        $this->bee->hit();
        $this->assertTrue($this->bee->isDead());
    }

    /**
     * @test
     */
    public function dead_drone_cannot_be_hit(): void
    {
        $this->setPrivateProperty($this->bee, 'lifespan', 0);
        $this->expectException(BeeAlreadyDead::class);
        $this->bee->hit();
    }

    /**
     * @test
     */
    public function can_get_correct_name(): void
    {
        $this->assertEquals('Drone', $this->bee->name());
    }
}
