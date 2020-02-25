<?php

require __DIR__.'/vendor/autoload.php';

$game = new Hive\Command\Game();

while(true) {
    $line = readline();
    if ('hit' === $line) {
        try {
            $game->run();
        } catch (\Hive\Exception\GameOverException $exception) {
            print $exception->getMessage(). PHP_EOL;
            die();
        }
    } else {
        print 'Correct command is hit'. PHP_EOL;
    }
}