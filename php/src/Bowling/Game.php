<?php

namespace Bowling;

use Bowling\Game\Frame\Bonus\BonusFrameStack;
use Bowling\Game\Frame\Bonus\BonusFrameStackInterface;
use Bowling\Game\Frame\FrameInterface;

class Game
{
    /**
     * @var FrameInterface
     */
    private $frameClass;

    /**
     * @var FrameInterface[]
     */
    private $frames;

    /**
     * @var FrameInterface[]
     */
    private $gameFrames;

    /**
     * @var int
     */
    private $frameNumber = 0;

    /**
     * @var BonusFrameStackInterface[]
     */
    private $bonusStack = [];


    public function __construct(string $frameClass, int $pitchCount)
    {
        /** @var FrameInterface $frameClass */
        $this->frameClass = $frameClass;
        $this->frames = $frameClass::factories($pitchCount);

        $this->gameFrames = $this->frames;

        $this->bonusStack = new BonusFrameStack;
    }

    public function setScore(int $first, int $second)
    {
        $frame = $this->current();
        $frame->setPoint($first, $second);

        $this->bonusStack->bonusLogic($frame);

        if ($this->isLastFrame()) {
            $this->addBonusGame($frame);
        }

        $this->frameNumber++;
    }

    public function isFinish() : bool
    {
        return isset($this->gameFrames[$this->frameNumber]);
    }

    public function getScore() : int
    {
        return array_reduce($this->frames, function (int $score, FrameInterface $frame) {
            $score += $frame->getTotalPoint();
            return $score;
        }, 0);
    }

    private function addBonusGame(FrameInterface $frame) : self
    {
        if (!$frame->isFullMark()) {
            return $this;
        }

        $frameClass = $this->frameClass;

        $pitchCount = ($frame->isStrike()) ? 2 : 1;

        $this->gameFrames = array_merge($this->gameFrames, $frameClass::factories($pitchCount));

        return $this;
    }

    private function current() : FrameInterface
    {
        return $this->gameFrames[$this->frameNumber];
    }

    private function isLastFrame() : bool
    {
        return (
            $this->frameNumber === count($this->frames) - 1
        );
    }
}
