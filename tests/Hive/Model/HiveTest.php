<?php
declare(strict_types=1);

namespace Tests\Hive\Model;

use Hive\Builder\HiveBuilder;
use Hive\Builder\HiveDirector;
use Hive\Exception\HiveEmpty;
use Hive\Model\Bee;
use Hive\Model\Drone;
use Hive\Model\Hive;
use PHPUnit\Framework\TestCase;
use Tests\ReflectionTrait;

class HiveTest extends TestCase
{
    use ReflectionTrait;

    /** @var Hive */
    private $hive;

    public function setUp(): void
    {
       $this->hive = (new HiveDirector(new HiveBuilder()))->build();
    }

    /**
     * @test
     */
    public function can_draw_a_bee_once(): void
    {
        $bee = $this->hive->draw();
        $this->assertInstanceOf(Bee::class, $bee);
    }

    /**
     * @test
     */
    public function can_draw_a_bee_twice(): void
    {
        $this->hive->draw();
        $bee = $this->hive->draw();
        $this->assertInstanceOf(Bee::class, $bee);
    }

    /**
     * @test
     */
    public function can_add_new_bee(): void
    {
        $count = \count($this->getPrivateProperty($this->hive, 'bees'));
        $this->hive->addBee(Drone::create());
        $this->assertEquals(++$count, \count($this->getPrivateProperty($this->hive, 'bees')));
    }

    /**
     * @test
     */
    public function can_calculate_hive_lifespan(): void
    {
        $this->assertEquals(875, $this->hive->lifespan());
    }

    /**
     * @test
     */
    public function can_calculate_hive_lifespan_after_hit(): void
    {
        $bee = $this->hive->draw();
        $bee->hit();
        $beeLifeSpan = $bee::DAMAGE;
        $this->assertEquals(875 - $beeLifeSpan, $this->hive->lifespan());
    }

    /**
     * @test
     */
    public function cannot_draw_empty_hive(): void
    {
        $hive = Hive::create();
        $this->expectException(HiveEmpty::class);
        $hive->draw();
    }
}