<?php
declare(strict_types = 1);

namespace Hive\Model;

use Hive\Exception\BeeAlreadyDead;
use Hive\Service\Hits;

abstract class Bee
{
    /** @var int */
    protected $lifespan;

    /** @var int */
    protected $damage;

    /** @var Hits */
    private $hit;

    /** @var bool */
    protected $dead;

    public function __construct(int $lifespan, int $power, Hits $hit)
    {
        $this->lifespan = $lifespan;
        $this->damage = $power;
        $this->hit = $hit;
        $this->dead = false;
    }

    /**
     * @throws BeeAlreadyDead
     */
    public function hit(): void
    {
        if(1 > $this->lifespan) {
            throw new BeeAlreadyDead();
        }

        $this->lifespan = $this->hit->hit($this->lifespan, $this->damage);
        if(0 === $this->lifespan) {
            $this->dead = true;
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
        return $this->dead;
    }
}