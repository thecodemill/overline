<?php

namespace TheCodeMill\Overline\Tests\Data\Series;

use TheCodeMill\Overline\Data\Series\Scalar;
use TheCodeMill\Overline\Tests\Data\SeriesTest;

class ScalarTest extends SeriesTest
{
    public function test_instantiation()
    {
        $point = new \TheCodeMill\Overline\Data\Point\Scalar('foo', 'bar');
        $series = new Scalar([$point, ['sna', 'fu']]);

        $this->assertEquals($series->count(), 2);
        $this->assertSame($series->first(), $point);
    }
}
