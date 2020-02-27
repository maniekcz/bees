<?php
declare(strict_types=1);

namespace Hive\Builder;

use Hive\Model\Drone;
use Hive\Model\Hive;
use Hive\Model\Queen;
use Hive\Model\Worker;
use Hive\Service\RandomBeeProvider;

class HiveBuilder implements HivePlan
{
    /** @var Hive */
    private $hive;

    public function createHive(): void
    {
        $this->hive = Hive::create(new RandomBeeProvider());
    }

    public function addQueen(): void
    {
        $this->hive->addBee(Queen::create());
    }

    public function addWorker(): void
    {
        $this->hive->addBee(Worker::create());
        $this->hive->addBee(Worker::create());
        $this->hive->addBee(Worker::create());
        $this->hive->addBee(Worker::create());
        $this->hive->addBee(Worker::create());
    }

    public function addDrone(): void
    {
        $this->hive->addBee(Drone::create());
        $this->hive->addBee(Drone::create());
        $this->hive->addBee(Drone::create());
        $this->hive->addBee(Drone::create());
        $this->hive->addBee(Drone::create());
        $this->hive->addBee(Drone::create());
        $this->hive->addBee(Drone::create());
        $this->hive->addBee(Drone::create());
    }

    /**
     * @return Hive
     */
    public function hive(): Hive
    {
        return $this->hive;
    }
}
