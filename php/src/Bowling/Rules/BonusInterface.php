<?php

namespace Bowling\Rules;

interface BonusInterface
{
    public function addPoint(int $point) : BonusInterface;

    public function isDie() : bool;
}