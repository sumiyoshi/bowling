<?php

use PHPUnit\Framework\TestCase;
use Bowling\Game;
use Bowling\Frame\Frame;

class GameTest extends TestCase
{
    public function test_すべて1ピン()
    {
        $game = $this->newGame();

        while ($game->isFinish()) {
            $game->setScore(1, 0);
        }

        $this->assertEquals($game->getScore(), 10);
    }

    public function test_すべて5ピン()
    {
        $game = $this->newGame();

        while ($game->isFinish()) {
            $game->setScore(5, 0);
        }

        $this->assertEquals($game->getScore(), 50);
    }

    public function test_すべてストライク()
    {
        $game = $this->newGame();

        while ($game->isFinish()) {
            $game->setScore(10, 0);
        }

        $this->assertEquals($game->getScore(), 300);
    }

    public function test_すべてスペア()
    {
        $game = $this->newGame();

        while ($game->isFinish()) {
            $game->setScore(5, 5);
        }

        $this->assertEquals($game->getScore(), 150);
    }

    private function newGame()
    {
        return new Game(
            new Frame,
            10
        );
    }
}
