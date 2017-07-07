<?php

namespace Bowling;

use Bowling\Rules\BonusInterface;
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
    private $frameStack = [];

    /**
     * @var BonusInterface[]
     */
    private $bonusFrameStack = [];

    public function __construct(array $data, FrameInterface $frame)
    {
        $this->frame = $frame;
        $this->createFrameStack($data);
    }

    public function getScore() : int
    {
        return array_reduce($this->frameStack, function (int $score, FrameInterface $frame) {
            $score += $frame->getTotalPoint();
            return $score;
        }, 0);
    }

    public function addBonusPoint(FrameInterface $frame) : void
    {
        $this->bonusFrameStack = array_map(function ($bonus) use ($frame) {
            /** @var BonusInterface $bonus */
            $bonus
                ->addPoint($frame->getFirstPoint())
                ->addPoint($frame->getSecondPoint());

            if ($point = $frame->getThirdPoint()) {
                $bonus->addPoint($point);
            }

            return $bonus;
        }, $this->bonusFrameStack);
    }

    public function setBonusFrame(FrameInterface $frame) : void
    {
        if (!$frame->isFullMark()) {
            return;
        }

        $this->bonusFrameStack[] = $frame->createBonus();
    }

    private function deleteFrameStack() : void
    {
        $this->bonusFrameStack = array_filter($this->bonusFrameStack, function ($bonus) {
            /** @var BonusInterface $bonus */
            return !$bonus->isDie();
        });
    }

    private function createFrameStack(array $data) : self
    {
        foreach ($data as $score) {

            $frame = $this->frame->createFrame($score);

            $this->addBonusPoint($frame);
            $this->setBonusFrame($frame);

            $this->deleteFrameStack();

            $this->frameStack[] = $frame;
        }

        return $this;
    }
}
