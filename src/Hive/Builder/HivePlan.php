<?php
declare(strict_types=1);

namespace Hive\Builder;

use Hive\Model\Hive;

interface HivePlan
{
    public function createHive(): void;
    public function addQueen(): void;
    public function addWorker(): void;
    public function addDrone(): void;
    public function hive(): Hive;
}