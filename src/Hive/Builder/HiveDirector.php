<?php
declare(strict_types=1);

namespace Hive\Builder;

use Hive\Model\Hive;

class HiveDirector
{
    /**
     * @var HivePlan
     */
    private $builders;

    public function __construct(HivePlan $builders)
    {
        $this->builders = $builders;
    }

    /**
     * @return Hive
     */
    public function build(): Hive
    {
        $this->builders->createHive();
        $this->builders->addDrone();
        $this->builders->addQueen();
        $this->builders->addWorker();
        return $this->builders->hive();
    }
}
