<?php

namespace Bowling\Rules;

interface FrameStackInterface
{
    public function bonusLogic(FrameInterface $frame);
}