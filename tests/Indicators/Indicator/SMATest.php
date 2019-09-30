<?php

namespace TheCodeMill\Overline\Tests\Indicators\Indicator;

use TheCodeMill\Overline\Indicators\Indicator\SMA;
use TheCodeMill\Overline\Tests\Indicators\IndicatorTest;

class SMATest extends IndicatorTest
{
    public function test_instantiation()
    {
        $indicator = SMA::make(['length' => 5]);

        $input = $indicator->getInputSeriesClass()::make([
            [0, 9],
            [1, 8],
            [2, 10],
            [3, 9],
            [4, 11],
            [5, 9],
            [6, 8],
            [7, 10],
            [8, 13],
            [9, 11],
        ]);

        $output = $indicator->compute($input);

        $this->assertEquals($output->count(), 1 + $input->count() - $indicator->getSetting('length'));
        $this->assertEquals($output->first()->getX(), 4);
        $this->assertEquals($output->first()->getY(), 9.4);
        $this->assertEquals($output->last()->getX(), 9);
        $this->assertEquals($output->last()->getY(), 10.2);
    }
}
