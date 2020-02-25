<?php
declare(strict_types=1);

namespace Hive\Service;

class RegularHit implements Hits
{
    public function hit(int $lifespan, int $damage): int
    {
        $restOfLifespan = $lifespan - $damage;
        if($restOfLifespan < 1) {
           return 0;
        }

        return $restOfLifespan;
    }
}