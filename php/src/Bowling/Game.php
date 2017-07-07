<?php

namespace Bowling;


use Bowling\Rules\Bonus;
use Bowling\Rules\FrameInterface;

class Game
{
    /**
     * @var FrameInterface
     */
    private $frame;

    /**
     * @var FrameInterface[]
     */
    private $frameStack;

    /**
     * @var FrameInterface[]
     */
    private $bonusFrameStack;

    public function __construct(FrameInterface $frameClass)
    {
        /** @var FrameInterface $frameClass */
        $this->frame = $frameClass;
//        $this->frames = $frameClass::factories($pitchCount);
//
//        $this->gameFrames = $this->frames;
//
//        $this->bonusStack = new BonusFrameStack;
    }

    public function getScore() : int
    {
        return array_reduce($this->frameStack, function (int $score, FrameInterface $frame) {
            $score += $frame->getTotalPoint();
            return $score;
        }, 0);
    }

    private function createFrameStack(array $data) : self
    {
        foreach ($data as $score) {

            $frame = $this->createFrame($score);

            $this->addBonusPoint($frame);
            $this->setBonusFrame($frame);


            $this->frameStack[] = $frame;
        }

        return $this;
    }

    private function createFrame($score) : FrameInterface
    {
        $frameClass = $this->frame;

        $first = $score[0] ?? 0;
        $second = $score[1] ?? 0;
        $third = $score[2] ?? 0;

        $frame = $frameClass::factory();
        $frame->setPoint($first, $second, $third);

        return $frame;
    }

    private function addBonusPoint(FrameInterface $frame) : void
    {

    }

    private function setBonusFrame(FrameInterface $frame) : void
    {
        if (!$frame->isFullMark()) {
            return;
        }

        $life = ($frame->isStrike()) ? 2 : 1;
        $this->bonusFrameStack[] = new Bonus($life, $frame);
    }


//    public function setScore(int $first, int $second)
//    {
//        $frame = $this->current();
//        $frame->setPoint($first, $second);
//
//        $this->bonusStack->bonusLogic($frame);
//
//        if ($this->isLastFrame()) {
//            $this->addBonusGame($frame);
//        }
//
//        $this->frameNumber++;
//    }
//
//    public function isFinish() : bool
//    {
//        return isset($this->gameFrames[$this->frameNumber]);
//    }
//

//
//    private function addBonusGame(FrameInterface $frame) : self
//    {
//        if (!$frame->isFullMark()) {
//            return $this;
//        }
//
//        $frameClass = $this->frameClass;
//
//        $pitchCount = ($frame->isStrike()) ? 2 : 1;
//
//        $this->gameFrames = array_merge($this->gameFrames, $frameClass::factories($pitchCount));
//
//        return $this;
//    }
//
//    private function current() : FrameInterface
//    {
//        return $this->gameFrames[$this->frameNumber];
//    }
//
//    private function isLastFrame() : bool
//    {
//        return (
//            $this->frameNumber === count($this->frames) - 1
//        );
//    }
}
