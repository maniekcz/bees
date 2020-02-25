<?php
declare(strict_types=1);

namespace Hive\Service;

use Hive\Exception\QueenDied;

class SpecialHit implements Hits
{
    public function hit(int $lifespan, int $damage): int
    {
        $restOfLifespan = $lifespan - $damage;
        if($restOfLifespan < 1) {
            throw new QueenDied();
        }

        return $restOfLifespan;
    }
}