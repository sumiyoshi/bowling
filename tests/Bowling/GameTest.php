<?php

use PHPUnit\Framework\TestCase;
use Bowling\Game;

class GameTest extends TestCase
{
    public function test_スコア取得()
    {
        $game = $this->newGame();
        $this->assertEquals($game->score(), 0);
    }

    private function newGame()
    {
        return new Game([]);
    }
}
