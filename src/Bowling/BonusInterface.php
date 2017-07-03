<?php

namespace Bowling;

interface BonusInterface
{
    public function getFrame() : FrameInterface;

    public function isDie() : bool;
}