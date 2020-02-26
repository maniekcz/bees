<?php
declare(strict_types=1);

namespace Hive\Model;

class Worker extends Bee
{
    /** @var int  */
    public const LIFESPAN = 75;

    /** @var int  */
    public const DAMAGE = 10;

    /**
     * @return Worker
     */
    public static function create(): Worker
    {
        return new self(static::LIFESPAN, static::DAMAGE);
    }
}
