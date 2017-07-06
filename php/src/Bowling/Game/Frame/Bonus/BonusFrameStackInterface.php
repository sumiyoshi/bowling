<?php

namespace Bowling\Game\Frame\Bonus;

use Bowling\Game\Frame\FrameInterface;

interface BonusFrameStackInterface
{
    public function bonusLogic(FrameInterface $frame);
}