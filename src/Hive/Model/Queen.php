<?php
declare(strict_types=1);

namespace Hive\Model;

use Hive\Service\Hits;

class Queen extends Bee
{
    /** @var int  */
    public const LIFESPAN = 100;

    /** @var int  */
    public const DAMAGE = 8;

    /**
     * @param Hits $hit
     * @return Queen
     */
    public static function create(Hits $hit): Queen
    {
        return new static(static::LIFESPAN, static::DAMAGE, $hit);
    }
}