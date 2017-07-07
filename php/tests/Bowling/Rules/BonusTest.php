<?php

use Bowling\Rules\Bonus;
use Bowling\Rules\BonusInterface;
use Bowling\Rules\Frame;
use PHPUnit\Framework\TestCase;

class BonusTest extends TestCase
{

    public function test_フレーム取得とライフ()
    {
        $bonus = new Bonus(2, new Frame());

        $this->assertEquals($bonus->addPoint(1) instanceof BonusInterface, true);
        $this->assertEquals($bonus->isDie(), false);

        $this->assertEquals($bonus->addPoint(1) instanceof BonusInterface, true);
        $this->assertEquals($bonus->isDie(), true);
    }

}