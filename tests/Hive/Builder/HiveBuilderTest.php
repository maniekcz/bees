<?php
declare(strict_types=1);

namespace Tests\Hive\Builder;

use Hive\Builder\HiveBuilder;
use Hive\Model\Drone;
use Hive\Model\Hive;
use Hive\Model\Queen;
use Hive\Model\Worker;
use PHPUnit\Framework\TestCase;
use Tests\ReflectionTrait;

class HiveBuilderTest extends TestCase
{
    use ReflectionTrait;

    /**
     * @test
     */
    public function can_create_hive(): void
    {
        $builder = new HiveBuilder();
        $builder->createHive();
        $this->assertInstanceOf(Hive::class, $builder->hive());
    }

    /**
     * @test
     */
    public function can_add_queen(): void
    {
        $builder = new HiveBuilder();
        $builder->createHive();
        $builder->addQueen();
        $bees = $this->getPrivateProperty($builder->hive(), 'bees');
        $this->assertCount(1, $bees);
        $this->assertInstanceOf(Queen::class, $bees[0]);
    }

    /**
     * @test
     */
    public function can_add_workers(): void
    {
        $builder = new HiveBuilder();
        $builder->createHive();
        $builder->addWorker();
        $bees = $this->getPrivateProperty($builder->hive(), 'bees');
        $this->assertCount(5, $bees);
        $this->assertInstanceOf(Worker::class, $bees[0]);
    }

    /**
     * @test
     */
    public function can_add_drones(): void
    {
        $builder = new HiveBuilder();
        $builder->createHive();
        $builder->addDrone();
        $bees = $this->getPrivateProperty($builder->hive(), 'bees');
        $this->assertCount(8, $bees);
        $this->assertInstanceOf(Drone::class, $bees[0]);
    }
}
