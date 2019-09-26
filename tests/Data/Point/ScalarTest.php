<?php

namespace TheCodeMill\Overline\Tests\Data\Point;

use TheCodeMill\Overline\Data\Point\Scalar;
use TheCodeMill\Overline\Tests\Data\PointTest;

class ScalarTest extends PointTest
{
    public function test_point_instantiation()
    {
        $x = 12345;
        $y = 'SOME VALUE';

        $point = new Scalar($x, $y);

        $this->assertEquals($point->getX(), $x);
        $this->assertEquals($point->getY(), $y);
    }
}
