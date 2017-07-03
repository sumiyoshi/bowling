<?php

namespace Bowling\Frame\Bonus;

use Bowling\Frame\FrameInterface;

class Bonus implements BonusInterface
{
    /**
     * @var int
     */
    private $life;

    /**
     * @var FrameInterface
     */
    private $frame;

    public function __construct(int $life, FrameInterface $frame)
    {
        $this->life = $life;
        $this->frame = $frame;
    }

    public function getFrame() : FrameInterface
    {
        $this->life--;
        return $this->frame;
    }

    public function isDie() : bool
    {
        return $this->life < 1;
    }
}