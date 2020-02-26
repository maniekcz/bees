<?php
declare(strict_types=1);

namespace Hive\Model;

use Hive\Exception\HiveEmpty;
use Hive\Service\Shuffler;

class Hive
{
    /** @var array|Bee[] */
    private $bees;

    /** @var Shuffler */
    private $shuffler;

    private function __construct(Shuffler $shuffler)
    {
        $this->bees = [];
        $this->shuffler = $shuffler;
    }

    /**
     * @param Shuffler $shuffler
     * @return self
     */
    public static function create(Shuffler $shuffler): self
    {
        return new self($shuffler);
    }

    public function addBee(Bee $bee): void
    {
        $this->bees[] = $bee;
    }

    public function lifespan(): int
    {
        return (int) array_reduce($this->bees, static function (int $lifespan, Bee $bee) {
            return $lifespan + $bee->lifespan();
        }, 0);
    }

    /**
     * @return Bee
     * @throws HiveEmpty
     */
    public function draw(): Bee
    {
        return $this->shuffler->shuffle($this->bees);
    }
}
