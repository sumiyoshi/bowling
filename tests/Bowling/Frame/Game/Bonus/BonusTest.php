<?php

use Bowling\Game\Frame\Bonus\Bonus;
use Bowling\Game\Frame\Frame;
use PHPUnit\Framework\TestCase;

class BonusTest extends TestCase
{

    public function test_フレーム取得とライフ()
    {
        $bonus = new Bonus(2, new Frame());

        $this->assertEquals($bonus->getFrame() instanceof Frame, true);
        $this->assertEquals($bonus->isDie(), false);

        $this->assertEquals($bonus->getFrame() instanceof Frame, true);
        $this->assertEquals($bonus->isDie(), true);
    }

}