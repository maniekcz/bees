<?php
declare(strict_types=1);

namespace Tests\Hive\Builder;

use Hive\Builder\HiveBuilder;
use Hive\Builder\HiveDirector;
use Hive\Model\Hive;
use PHPUnit\Framework\TestCase;

class HiveDirectorTest extends TestCase
{
    /**
     * @test
     */
    public function can_build_hive(): void
    {
        $builder = new HiveDirector(new HiveBuilder());
        $hive = $builder->build();
        $this->assertInstanceOf(Hive::class, $hive);
        $this->assertNotEquals(0, $hive->lifespan());
    }
}
