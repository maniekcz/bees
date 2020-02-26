<?php
declare(strict_types=1);

namespace Hive\Repository;

use Hive\Model\Hive;

interface HiveRepository
{
    /**
     * @return Hive
     * @throw \Exception
     */
    public function get(): Hive;
}