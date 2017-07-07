<?php

use Bowling\Game;
use Bowling\Rules\Frame;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function test_すべて1ピン()
    {
        $game = $this->newGame([
            [1, 1],
            [1, 1],
            [1, 1],
            [1, 1],
            [1, 1],
            [1, 1],
            [1, 1],
            [1, 1],
            [1, 1],
            [1, 1]
        ]);

        $this->assertEquals($game->getScore(), 20);
    }

    public function test_すべて5ピン()
    {
        $game = $this->newGame([
            [5, 0],
            [5, 0],
            [5, 0],
            [5, 0],
            [5, 0],
            [5, 0],
            [5, 0],
            [5, 0],
            [5, 0],
            [5, 0]
        ]);

        $this->assertEquals($game->getScore(), 50);
    }

    public function test_すべてスペア()
    {
        $game = $this->newGame([
            [5, 5],
            [5, 5],
            [5, 5],
            [5, 5],
            [5, 5],
            [5, 5],
            [5, 5],
            [5, 5],
            [5, 5],
            [5, 5, 5]
        ]);

        $this->assertEquals($game->getScore(), 150);

        $game = $this->newGame([
            [5, 5],
            [5, 5],
            [5, 5],
            [5, 5],
            [5, 5],
            [5, 5],
            [5, 5],
            [5, 5],
            [5, 5],
            [5, 5, 10]
        ]);

        $this->assertEquals($game->getScore(), 155);
    }

    public function test_すべてストライク()
    {
        $game = $this->newGame([
            [10, 0],
            [10, 0],
            [10, 0],
            [10, 0],
            [10, 0],
            [10, 0],
            [10, 0],
            [10, 0],
            [10, 0],
            [10, 10, 10]
        ]);

        $this->assertEquals($game->getScore(), 300);
    }

    private function newGame(array $data)
    {
        return new Game(
            $data,
            new Frame(\Bowling\Rules\Bonus::class)
        );
    }
}
