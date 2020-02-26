<?php
declare(strict_types=1);

namespace Tests\Hive\Service;

use Hive\Exception\HiveEmpty;
use Hive\Model\Bee;
use Hive\Service\Shuffler;

class FirstShuffler implements Shuffler
{
    public function shuffle(array $bees): Bee
    {
        if (empty($bees)) {
            throw new HiveEmpty();
        }

        return $bees[0];
    }
}
