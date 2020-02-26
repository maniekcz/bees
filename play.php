<?php

use Hive\Builder\HiveBuilder;
use Hive\Builder\HiveDirector;
use Hive\Service\PrintLogger;
use Hive\Command\Game;
use Hive\Exception\GameOverException;
use Hive\Repository\InMemoryHiveRepository;

require __DIR__.'/vendor/autoload.php';

$game = new Game(
    new InMemoryHiveRepository((new HiveDirector(new HiveBuilder()))->build()),
    new PrintLogger()
);

while(true) {
    $line = readline();
    if ('hit' === $line) {
        try {
            $game->run();
        } catch (GameOverException $exception) {
            die();
        } catch (\Exception $exception)  {
            die('An error occurred, please try again later.');
        }
    } else {
        print 'Correct command is hit'. PHP_EOL;
    }
}