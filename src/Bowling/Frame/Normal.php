<?php

namespace Bowling\Frame;

use Bowling\Exception\PointOverException;
use Bowling\FrameInterface;
use Prophecy\Exception\Doubler\ReturnByReferenceException;

class Normal implements FrameInterface
{

    const POINT_LIMIT = 10;

    /**
     * @var int
     */
    private $first;

    /**
     * @var int
     */
    private $second;

    /**
     * @var int
     */
    private $bonus;

    public function setPoint(int $first, int $second) : FrameInterface
    {
        $this->first = $first;
        $this->second = $second;

        return $this;
    }

    public function addBonus(int $point) : FrameInterface
    {
        if ($point > static::POINT_LIMIT) {
            throw new PointOverException();
        }

        $this->bonus += $point;

        return $this;
    }

    public function getPoint() : int
    {
        return $this->calculationScore();
    }

    public function getTotalPoint() : int
    {
        return $this->getPoint() + $this->bonus;
    }

    public function isStrike() : bool
    {
        return $this->first === 10;
    }

    public function isSpare() : bool
    {
        return !$this->isStrike() && $this->getPoint() === 10;
    }

    public static function factories(int $number) : array
    {
        return array_map(function () {
            return new self;
        }, range(0, $number - 1));
    }

    private function calculationScore() : int
    {
        $point = $this->first + $this->second;

        if ($point > static::POINT_LIMIT) {
            throw new PointOverException();
        }

        return $point;
    }

}