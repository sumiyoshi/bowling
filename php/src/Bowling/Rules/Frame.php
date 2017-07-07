<?php

namespace Bowling\Rules;

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
    protected $third;

    /**
     * @var int
     */
    protected $bonus;

    public function setPoint(int $first, int $second, int $third = 0) : FrameInterface
    {

        if (
            $first > static::POINT_LIMIT ||
            $second > static::POINT_LIMIT ||
            $third > static::POINT_LIMIT
        ) {
            throw new \Exception('Point is an illegal value');
        }


        $this->first = $first;
        $this->second = $second;
        $this->third = $third;

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

    public function getFirstPoint() : int
    {
        return $this->first;
    }

    public function getSecondPoint() : int
    {
        return $this->second;
    }

    public function getThirdPoint() : int
    {
        return $this->third;
    }
    
    public function getPoint() : int
    {
        return $this->first + $this->second + $this->third;
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

    public static function factory() : FrameInterface
    {
        return new static;
    }

}