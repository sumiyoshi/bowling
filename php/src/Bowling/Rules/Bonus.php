<?php

namespace Bowling\Rules;

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

    public function addPoint(int $point) : BonusInterface
    {
        if (
            $point === 0 ||
            $this->isDie()
        ) {
            return $this;
        }

        $this->frame->addBonus($point);
        $this->life--;
        
        return $this;
    }

    public function isDie() : bool
    {
        return $this->life < 1;
    }
}