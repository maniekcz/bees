<?php
declare(strict_types=1);

namespace Hive\Model;

class Drone extends Bee
{
    /** @var int  */
    public const LIFESPAN = 50;

    /** @var int  */
    public const DAMAGE = 12;

    /**
     * @return Drone
     */
    public static function create(): Drone
    {
        return new static(static::LIFESPAN, static::DAMAGE);
    }
}