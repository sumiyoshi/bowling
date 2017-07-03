<?php

use Bowling\Bonus;
use Bowling\Frame\NormalFrame;
use PHPUnit\Framework\TestCase;

class BonusTest extends TestCase
{

    public function test_フレーム取得とライフ()
    {
        $bonus = new Bonus(2, new NormalFrame());

        $this->assertEquals($bonus->getFrame() instanceof NormalFrame, true);
        $this->assertEquals($bonus->isDie(), false);

        $this->assertEquals($bonus->getFrame() instanceof NormalFrame, true);
        $this->assertEquals($bonus->isDie(), true);
    }

}