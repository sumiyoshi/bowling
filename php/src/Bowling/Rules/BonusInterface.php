<?php

namespace Bowling\Rules;

interface BonusInterface
{
    public function getFrame() : FrameInterface;

    public function isDie() : bool;
}