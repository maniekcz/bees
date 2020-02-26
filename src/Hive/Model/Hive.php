<?php
declare(strict_types=1);

namespace Hive\Model;

use Hive\Exception\HiveEmpty;

class Hive
{
    /** @var array  */
    private $bees;

    private function __construct()
    {
        $this->bees = [];
    }
    /**
     * @return static
     */
    public static function create(): self
    {
        return new self();
    }

    public function addBee(Bee $bee): void
    {
        $this->bees[] = $bee;
    }

    public function lifespan(): int
    {
        return array_reduce($this->bees, static function(int $lifespan, Bee $bee) {
            return $lifespan + $bee->lifespan();
        }, 0);
    }

    /**
     * @throws HiveEmpty
     */
    public function draw(): Bee
    {
        return $this->bees[array_rand(
            $this->lifeBees()
        )];
    }

    /**
     * @return array|Bee[]
     * @throws HiveEmpty
     */
    private function lifeBees(): array
    {
        $bees = array_filter($this->bees, static function(Bee $bee) {
            return !$bee->isDead();
        });

        if(empty($bees)) {
            throw new HiveEmpty();
        }

        return $bees;
    }
}