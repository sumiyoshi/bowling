<?php

namespace Bowling\Rules;

class FrameStack implements FrameStackInterface
{
    /**
     * @var BonusInterface[]
     */
    private $frames;

    public function bonusLogic(FrameInterface $frame)
    {
        $this->addBonusPoint($frame)
            ->addBonusList($frame);
    }

    private function addBonusPoint(FrameInterface $frame) : self
    {
        if (
            !$this->frames ||
            (!$frame->isFullMark())

        ) {
            return $this;
        }

        foreach ($this->frames as $key => $bonus) {
            $bonusFrame = $bonus->getFrame();
            $bonusFrame->addBonus($frame->getAddPoint());

            if ($bonus->isDie()) {
                unset($this->frames[$key]);
            }
        }

        return $this;
    }

    private function addBonusList(FrameInterface $frame) : self
    {
        if ($frame->isStrike()) {
            $this->frames[] = new Bonus(2, $frame);

            return $this;
        }

        if ($frame->isSpare()) {
            $this->frames[] = new Bonus(1, $frame);

            return $this;
        }

        return $this;
    }
}