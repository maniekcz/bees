<?php
declare(strict_types=1);

namespace Hive\Service;

use Hive\Exception\HiveEmpty;
use Hive\Model\Bee;

class RandomBeeProvider implements BeeProvider
{
    /**
     * @param array $bees
     * @return Bee
     * @throws HiveEmpty
     */
    public function shuffle(array $bees): Bee
    {
        if (empty($bees)) {
            throw new HiveEmpty();
        }

        $livingBees = array_filter($bees, static function (Bee $bee) {
            return !$bee->isDead();
        });

        if (empty($livingBees)) {
            throw new HiveEmpty();
        }

        return $bees[array_rand(
            $livingBees
        )];
    }
}
