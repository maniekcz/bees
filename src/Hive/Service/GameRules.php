<?php
declare(strict_types=1);

namespace Hive\Service;

use Hive\Exception\BeeAlreadyDead;
use Hive\Exception\GameOverException;
use Hive\Exception\HiveEmpty;
use Hive\Exception\QueenDied;
use Hive\Model\Hive;

class GameRules implements Rules
{
    /** @var Hive */
    private $hive;

    private function __construct(Hive $hive)
    {
        $this->hive = $hive;
    }

    /**
     * @param Hive $hive
     * @return static
     */
    public static function create(Hive $hive): self
    {
        return new self($hive);
    }

    /**
     * @throws GameOverException
     * @throws BeeAlreadyDead
     */
    public function play(): void
    {
        try {
            $bee = $this->hive->draw();
            $bee->hit();
            printf('Direct Hit. You took %s hit points from a %s bee' . PHP_EOL, $bee::DAMAGE, get_class($bee));
        } catch(HiveEmpty|QueenDied $exception) {
            throw new GameOverException(
                sprintf('Left %s hints', $this->hive->lifespan())
            );
        }
    }
}