<?php

namespace Bowling\Frame\Bonus;

use Bowling\Frame\FrameInterface;

interface BonusInterface
{
    public function getFrame() : FrameInterface;

    public function isDie() : bool;
}