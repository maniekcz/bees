<?php
declare(strict_types=1);

namespace Hive\Command;

use Hive\Builder\HiveDirector;
use Hive\Builder\HiveBuilder;
use Hive\Exception\BeeAlreadyDead;
use Hive\Exception\GameOverException;
use Hive\Service\GameRules;
use Hive\Service\Rules;

class Game
{
    /** @var Rules */
    private $rule;

    public function __construct()
    {
        $this->rule = GameRules::create(
            (new HiveDirector(new HiveBuilder()))->build()
        );
    }

    /**
     * @throws GameOverException
     * @throws BeeAlreadyDead
     */
    public function run(): void
    {
         $this->rule->play();
    }
}