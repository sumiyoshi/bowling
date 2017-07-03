<?php

namespace Bowling;

class Game
{
    /**
     * @var array
     */
    private $frames;

    public function __construct(array $frames)
    {
        $this->frames = $frames;
    }

    public function score() : int
    {
        return 0;
    }
}
