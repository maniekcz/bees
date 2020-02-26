<?php
declare(strict_types=1);

namespace Hive\Model;

use Hive\Exception\BeeAlreadyDead;
use Hive\Exception\QueenDied;

class Queen extends Bee
{
    /** @var int  */
    public const LIFESPAN = 100;

    /** @var int  */
    public const DAMAGE = 8;

    /**
     * @return Queen
     */
    public static function create(): Queen
    {
        return new static(static::LIFESPAN, static::DAMAGE);
    }

    /**
     * @throws QueenDied
     * @throws BeeAlreadyDead
     */
    public function hit(): void
    {
        parent::hit();
        if(1 > $this->lifespan) {
            throw new QueenDied();
        }
    }
}