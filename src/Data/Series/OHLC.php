<?php

namespace TheCodeMill\Overline\Data\Series;

use TheCodeMill\Overline\Data\Series;
use TheCodeMill\Overline\Data\Point\OHLC as OHLCPoint;

class OHLC extends Series
{
    /**
     * Expected point base class.
     *
     * @var string
     */
    protected $pointClass = OHLCPoint::class;
}
