<?php
declare(strict_types = 1);

namespace Hive\Model;

use Hive\Exception\BeeAlreadyDead;

abstract class Bee
{
    /** @var int  */
    public const DAMAGE = 12;

    /** @var int */
    protected $lifespan;

    /** @var int */
    protected $damage;

    public function __construct(int $lifespan, int $power)
    {
        $this->lifespan = $lifespan;
        $this->damage = $power;
    }

    /**
     * @throws BeeAlreadyDead
     */
    public function hit(): void
    {
        if (1 > $this->lifespan) {
            throw new BeeAlreadyDead();
        }

        $this->lifespan -= $this->damage();

        if (1 > $this->lifespan) {
            $this->lifespan = 0;
        }
    }

    /**
     * @return int
     */
    public function lifespan(): int
    {
        return $this->lifespan;
    }

    /**
     * @return bool
     */
    public function isDead(): bool
    {
        return 0 === $this->lifespan;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        $path = explode('\\', __CLASS__);
        return array_pop($path);
    }

    /**
     * @return int
     */
    public function damage(): int
    {
        return static::DAMAGE;
    }
}
