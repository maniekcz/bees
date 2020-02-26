<?php
declare(strict_types=1);

namespace Tests\Hive\Model;

use Hive\Exception\BeeAlreadyDead;
use Hive\Exception\QueenDied;
use Hive\Model\Queen;
use PHPUnit\Framework\TestCase;
use Tests\ReflectionTrait;

class QueenTest extends TestCase
{
    use ReflectionTrait;

    /** @var Queen */
    protected $bee;

    public function setUp(): void
    {
        $this->bee = Queen::create();
    }

    /**
     * @test
     */
    public function queen_can_be_hit_once(): void
    {
        $this->bee->hit();
        $this->assertEquals(Queen::LIFESPAN - Queen::DAMAGE, $this->bee->lifespan());
    }

    /**
     * @test
     */
    public function queen_can_be_hit_twice(): void
    {
        $this->bee->hit();
        $this->bee->hit();
        $this->assertEquals(Queen::LIFESPAN - Queen::DAMAGE - Queen::DAMAGE, $this->bee->lifespan());
    }

    /**
     * @test
     */
    public function queen_can_be_killed(): void
    {
        $this->setPrivateProperty($this->bee, 'lifespan', Queen::DAMAGE);
        $this->expectException(QueenDied::class);
        $this->bee->hit();
    }

    /**
     * @test
     */
    public function dead_queen_cannot_be_hit(): void
    {
        $this->setPrivateProperty($this->bee, 'lifespan', 0);
        $this->expectException(BeeAlreadyDead::class);
        $this->bee->hit();
    }
}
