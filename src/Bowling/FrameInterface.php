<?php

namespace Bowling;

interface FrameInterface
{
    public function setPoint(int $first, int $second) : FrameInterface;

    public function addBonus(int $point) : FrameInterface;

    public function getPoint() : int;

    public function getAddPoint() : int;

    public function getTotalPoint() : int;

    public function isFullMark() : bool;

    public function isStrike() : bool;

    public function isSpare() : bool;

    public static function factories(int $number) : array;
}