<?php

namespace Bowling\Frame;

use Bowling\FrameInterface;
use PHPUnit\Framework\TestCase;

class NormalTest extends TestCase
{

    public function test_点数保存()
    {
        $frame = $this->newFrame();
        $this->assertEquals($frame->setPoint('2', 1) instanceof FrameInterface, true);
    }

    public function test_ボーナス保存()
    {
        $frame = $this->newFrame();

        try {
            $this->assertEquals($frame->addBonus(1) instanceof FrameInterface, true);
            $this->assertEquals($frame->addBonus(10) instanceof FrameInterface, true);
            $this->assertEquals($frame->addBonus(11) instanceof FrameInterface, true);

            # ここは通らない
            $this->assertEquals(1, 0);
        } catch (\Exception $e) {
            $this->assertEquals($e->getMessage(), 'Point is an illegal value');
        }
    }

    public function test_点数取得()
    {
        $frame = $this->newFrame();

        $frame->setPoint(1, 1);
        $this->assertEquals($frame->getPoint(), 2);

        $frame->setPoint(1, 0);
        $this->assertEquals($frame->getPoint(), 1);

        $frame->setPoint(0, 10);
        $this->assertEquals($frame->getPoint(), 10);

        $frame->setPoint(0, 10);
        $frame->addBonus(10);
        $this->assertEquals($frame->getPoint(), 10);

        try {
            $frame->setPoint(1, 10);
            $this->assertEquals($frame->getPoint(), 10);

            # ここは通らない
            $this->assertEquals(1, 0);
        } catch (\Exception $e) {
            $this->assertEquals($e->getMessage(), 'Point is an illegal value');
        }

    }

    public function test_合計点数取得()
    {
        $frame = $this->newFrame();

        $frame->setPoint(0, 10);
        $frame->addBonus(10);
        $this->assertEquals($frame->getTotalPoint(), 20);
    }

    public function test_ストライクか()
    {
        $frame = $this->newFrame();

        $frame->setPoint(0, 10);
        $this->assertEquals($frame->isStrike(), false);

        $frame->setPoint(10, 0);
        $this->assertEquals($frame->isStrike(), true);
    }

    public function test_スペアか()
    {
        $frame = $this->newFrame();

        $frame->setPoint(0, 0);
        $this->assertEquals($frame->isSpare(), false);

        $frame->setPoint(10, 0);
        $this->assertEquals($frame->isSpare(), false);

        $frame->setPoint(5, 5);
        $this->assertEquals($frame->isSpare(), true);

        $frame->setPoint(0, 10);
        $this->assertEquals($frame->isSpare(), true);
    }

    public function test_ファクトリー()
    {
        $frames = Normal::factories(10);
        $this->assertEquals(count($frames), 10);

        foreach ($frames as $frame) {
            $this->assertEquals($frame instanceof Normal, true);
        }
    }

    private function newFrame()
    {
        return new Normal();
    }

}