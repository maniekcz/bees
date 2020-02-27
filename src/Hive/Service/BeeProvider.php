<?php
declare(strict_types=1);

namespace Hive\Service;

use Hive\Exception\HiveEmpty;
use Hive\Model\Bee;

interface BeeProvider
{
    /**
     * @param array|Bee[] $bees
     * @return Bee
     * @throws HiveEmpty
     */
    public function shuffle(array $bees): Bee;
}
