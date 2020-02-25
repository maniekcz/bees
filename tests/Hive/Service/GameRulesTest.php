<?php
declare(strict_types=1);

namespace Tests\Hive\Service;

use Hive\Exception\GameOverException;
use Hive\Model\Hive;
use Hive\Model\Queen;
use Hive\Service\GameRules;
use Hive\Service\SpecialHit;
use PHPUnit\Framework\TestCase;
use Tests\ReflectionTrait;

class GameRulesTest extends TestCase
{
    use ReflectionTrait;

    /**
     * @test
     */
    public function can_finish_game_when_queen_died(): void
    {
        $hive = Hive::create();
        $queen = Queen::create(new SpecialHit());
        $this->setPrivateProperty($queen, 'lifespan', Queen::DAMAGE);
        $hive->addBee(
            $queen
        );
        $rule = GameRules::create($hive);
        $this->expectException(GameOverException::class);
        $rule->play();
    }

    /**
     * @test
     */
    public function can_finish_game_when_hive_is_empty(): void
    {
        $hive = Hive::create();
        $rule = GameRules::create($hive);
        $this->expectException(GameOverException::class);
        $rule->play();
    }
}