<?php

namespace Bowling\Rules;

interface FrameInterface
{
    public function setPoint(int $first, int $second, int $third = 0) : FrameInterface;

    public function addBonus(int $point) : FrameInterface;

    public function getFirstPoint() : int;

    public function getSecondPoint() : int;

    public function getThirdPoint() : int;

    public function getPoint() : int;

    public function getTotalPoint() : int;

    public function isFullMark() : bool;

    public function isStrike() : bool;

    public function isSpare() : bool;

    public static function factory() : FrameInterface;
}