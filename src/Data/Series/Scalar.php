<?php

namespace TheCodeMill\Overline\Data\Series;

use TheCodeMill\Overline\Data\Series;
use TheCodeMill\Overline\Data\Point\Scalar as ScalarPoint;

class Scalar extends Series
{
    /**
     * Expected point base class.
     *
     * @var string
     */
    protected $pointClass = ScalarPoint::class;
}
