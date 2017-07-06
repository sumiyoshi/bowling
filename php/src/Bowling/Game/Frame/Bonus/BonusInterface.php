<?php

namespace Bowling\Game\Frame\Bonus;

use Bowling\Game\Frame\FrameInterface;

interface BonusInterface
{
    public function getFrame() : FrameInterface;

    public function isDie() : bool;
}