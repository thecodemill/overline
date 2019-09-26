<?php

namespace TheCodeMill\Overline\Tests\Indicators\Indicator;

use TheCodeMill\Overline\Tests\Indicators\IndicatorTest;
use TheCodeMill\Overline\Indicators\Indicator\LinearRegression;

class LinearRegressionTest extends IndicatorTest
{
    public function test_instantiation()
    {
        $indicator = LinearRegression::make(['length' => 5]);

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

        $this->assertEquals($output->slope(), 0.9);
    }
}
