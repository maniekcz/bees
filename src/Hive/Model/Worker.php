<?php
declare(strict_types=1);

namespace Hive\Model;

use Hive\Service\Hits;

class Worker extends Bee
{
    /** @var int  */
    public const LIFESPAN = 75;

    /** @var int  */
    public const DAMAGE = 10;

    /**
     * @param Hits $hit
     * @return Worker
     */
    public static function create(Hits $hit): Worker
    {
        return new static(static::LIFESPAN, static::DAMAGE, $hit);
    }
}