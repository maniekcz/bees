<?php
declare(strict_types=1);

namespace Hive\Model;

use Hive\Service\Hits;

class Drone extends Bee
{
    /** @var int  */
    public const LIFESPAN = 50;

    /** @var int  */
    public const DAMAGE = 12;

    /**
     * @param Hits $hit
     * @return Drone
     */
    public static function create(Hits $hit): Drone
    {
        return new static(static::LIFESPAN, static::DAMAGE, $hit);
    }
}