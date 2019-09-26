<?php

namespace TheCodeMill\Overline\Tests\Data\Point;

use TheCodeMill\Overline\Data\Point\OHLC;
use TheCodeMill\Overline\Tests\Data\PointTest;

class OHLCTest extends PointTest
{
    public function test_point_instantiation()
    {
        $x = 12345;
        $y = [
            'o' => 1.5,
            'h' => 1.7,
            'l' => 1.4,
            'c' => 1.6,
        ];

        $point = new OHLC($x, $y);

        $this->assertEquals($point->getX(), $x);
        $this->assertEquals($point->getY(), $y);

        $this->assertEquals($point->getO(), $y['o']);
        $this->assertEquals($point->getH(), $y['h']);
        $this->assertEquals($point->getL(), $y['l']);
        $this->assertEquals($point->getC(), $y['c']);

        $this->assertEquals($point->o, $y['o']);
        $this->assertEquals($point->h, $y['h']);
        $this->assertEquals($point->l, $y['l']);
        $this->assertEquals($point->c, $y['c']);
    }

    public function test_bad_y_type()
    {
        $x = 12345;

        $this->expectException(\InvalidArgumentException::class);

        $point = new OHLC($x, 'NOT AN ARRAY');
    }

    public function test_empty_y_value()
    {
        $x = 12345;

        $this->expectException(\InvalidArgumentException::class);

        $point = new OHLC($x, []);
    }

    public function test_incomplete_y_value()
    {
        $x = 12345;

        $this->expectException(\InvalidArgumentException::class);

        $point = new OHLC($x, ['o' => 1.5]);
    }

    public function test_data_manipulation()
    {
        $x = 12345;
        $y = [
            'o' => 1.5,
            'h' => 1.7,
            'l' => 1.4,
            'c' => 1.6,
        ];
        $y2 = [
            'o' => 2.5,
            'h' => 2.7,
            'l' => 2.4,
            'c' => 2.6,
        ];
        $y3 = [
            'o' => 3.5,
            'h' => 3.7,
            'l' => 3.4,
            'c' => 3.6,
        ];

        $point = new OHLC($x, $y);

        $point->setY($y2);
        $this->assertEquals($point->getY(), $y2);

        $point->setO($y3['o']);
        $point->setH($y3['h']);
        $point->setL($y3['l']);
        $point->setC($y3['c']);
        $this->assertEquals($point->getY(), $y3);
    }
}
