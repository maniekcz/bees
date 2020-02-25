<?php
declare(strict_types=1);

namespace Hive\Builder;

use Hive\Model\Drone;
use Hive\Model\Hive;
use Hive\Model\Queen;
use Hive\Model\Worker;
use Hive\Service\RegularHit;
use Hive\Service\SpecialHit;

class HiveBuilder implements Builders
{
    /** @var Hive */
    private $hive;

    public function createHive(): void
    {
        $this->hive = Hive::create();
    }

    public function addQueen(): void
    {
        $this->hive->addBee(Queen::create(new SpecialHit()));
    }

    public function addWorker(): void
    {
        $this->hive->addBee(Worker::create(new RegularHit()));
        $this->hive->addBee(Worker::create(new RegularHit()));
        $this->hive->addBee(Worker::create(new RegularHit()));
        $this->hive->addBee(Worker::create(new RegularHit()));
        $this->hive->addBee(Worker::create(new RegularHit()));
    }

    public function addDrone(): void
    {
        $this->hive->addBee(Drone::create(new RegularHit()));
        $this->hive->addBee(Drone::create(new RegularHit()));
        $this->hive->addBee(Drone::create(new RegularHit()));
        $this->hive->addBee(Drone::create(new RegularHit()));
        $this->hive->addBee(Drone::create(new RegularHit()));
        $this->hive->addBee(Drone::create(new RegularHit()));
        $this->hive->addBee(Drone::create(new RegularHit()));
        $this->hive->addBee(Drone::create(new RegularHit()));
    }

    public function hive(): Hive
    {
        return $this->hive;
    }
}