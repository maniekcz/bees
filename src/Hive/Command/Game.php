<?php
declare(strict_types=1);

namespace Hive\Command;

use Hive\Exception\BeeAlreadyDead;
use Hive\Exception\GameOverException;
use Hive\Exception\HiveEmpty;
use Hive\Exception\QueenDied;
use Hive\Repository\HiveRepository;
use Psr\Log\LoggerInterface;

class Game
{
    /** @var HiveRepository */
    private $repository;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(HiveRepository $repository, LoggerInterface $logger)
    {
        $this->repository = $repository;
        $this->logger = $logger;
    }

    /**
     * @throws GameOverException
     * @throws BeeAlreadyDead
     */
    public function run(): void
    {
        $hive = $this->repository->get();
        try {
            $bee = $hive->draw();
            $bee->hit();
            $this->logger->info(
                sprintf('Direct Hit. You took %s hit points from a %s bee' . PHP_EOL, $bee->damage(), $bee->name())
            );
        } catch (HiveEmpty|QueenDied $exception) {
            $this->logger->info(
                sprintf('Left %s hints', $hive->lifespan())
            );
            throw new GameOverException();
        }
    }
}
