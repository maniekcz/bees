<?php
declare(strict_types=1);

namespace Hive\Service;

interface Hits
{
    public function hit(int $lifespan, int $damage): int;
}