<?php

namespace Bowling;

use Bowling\Frame\Bonus\Bonus;
use Bowling\Frame\Bonus\BonusInterface;
use Bowling\Frame\FrameInterface;

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
     * @var BonusInterface[]
     */
    private $bonusStack = [];

    public function __construct(FrameInterface $frameClass, int $pitchCount)
    {
        $this->frameClass = $frameClass;
        $this->frames = $frameClass::factories($pitchCount);

        $this->gameFrames = $this->frames;
    }

    public function setScore(int $first, int $second)
    {
        $frame = $this->current();
        $frame->setPoint($first, $second);

        $this->addBonusPoint($frame)
            ->addBonusList($frame);

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

    private function addBonusPoint(FrameInterface $frame) : self
    {
        if (
            !$this->bonusStack ||
            (!$frame->isFullMark())

        ) {
            return $this;
        }

        foreach ($this->bonusStack as $key => $bonus) {
            $bonusFrame = $bonus->getFrame();
            $bonusFrame->addBonus($frame->getAddPoint());

            if ($bonus->isDie()) {
                unset($this->bonusStack[$key]);
            }
        }

        return $this;
    }

    private function addBonusList(FrameInterface $frame) : self
    {
        if ($frame->isStrike()) {
            $this->bonusStack[] = new Bonus(2, $frame);

            return $this;
        }

        if ($frame->isSpare()) {
            $this->bonusStack[] = new Bonus(1, $frame);

            return $this;
        }

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
