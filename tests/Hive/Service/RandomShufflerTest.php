<?php
declare(strict_types=1);

namespace Tests\Hive\Service;

use Hive\Exception\HiveEmpty;
use Hive\Model\Bee;
use Hive\Model\Queen;
use Hive\Model\Worker;
use Hive\Service\RandomBeeProvider;
use PHPUnit\Framework\TestCase;
use Tests\ReflectionTrait;

class RandomShufflerTest extends TestCase
{
    use ReflectionTrait;

    /**
     * @test
     */
    public function can_shuffle(): void
    {
        $shuffler = new RandomBeeProvider();
        $this->assertInstanceOf(Bee::class, $shuffler->shuffle([Queen::create(), Worker::create()]));
    }

    /**
     * @test
     */
    public function cannot_shuffle_without_bees(): void
    {
        $shuffler = new RandomBeeProvider();
        $this->expectException(HiveEmpty::class);
        $shuffler->shuffle([]);
    }

    /**
     * @test
     */
    public function cannot_shuffle_without_living_bees(): void
    {
        $shuffler = new RandomBeeProvider();
        $bee = Worker::create();
        $this->setPrivateProperty($bee, 'lifespan', 0);

        $this->expectException(HiveEmpty::class);
        $shuffler->shuffle([$bee]);
    }
}
