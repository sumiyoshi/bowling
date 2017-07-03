<?php

namespace Bowling\Frame;

class Frame implements FrameInterface
{

    const POINT_LIMIT = 10;

    /**
     * @var int
     */
    protected $first;

    /**
     * @var int
     */
    protected $second;

    /**
     * @var int
     */
    protected $bonus;

    public function setPoint(int $first, int $second) : FrameInterface
    {
        $this->first = $first;
        $this->second = $second;

        return $this;
    }

    public function addBonus(int $point) : FrameInterface
    {
        if ($point > static::POINT_LIMIT) {
            throw new \Exception('Point is an illegal value');
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

    public function isFullMark() : bool
    {
        return $this->getPoint() === static::POINT_LIMIT;
    }

    public function isStrike() : bool
    {
        return $this->first === static::POINT_LIMIT;
    }

    public function isSpare() : bool
    {
        return !$this->isStrike() && $this->getPoint() === static::POINT_LIMIT;
    }

    public function getAddPoint() : int
    {
        if (!$this->isStrike() && !$this->isSpare()) {
            return 0;
        }

        return $this->isStrike() ? $this->getPoint() : $this->first;
    }

    public static function factories(int $number) : array
    {
        return array_map(function () {
            return new static;
        }, range(0, $number - 1));
    }

    protected function calculationScore() : int
    {
        $point = $this->first + $this->second;

        if ($point > static::POINT_LIMIT) {
            throw new \Exception('Point is an illegal value');
        }

        return $point;
    }

}