<?php

namespace TheCodeMill\Overline\Data\Series;

use TheCodeMill\Overline\Data\Series;
use TheCodeMill\Overline\Data\Point\Line as LinePoint;

class Line extends Series
{
    /**
     * Expected point base class.
     *
     * @var string
     */
    protected $pointClass = LinePoint::class;

    /**
     * Maximum number of points allowed.
     *
     * @var int
     */
    protected $maxPoints = 1;

    /**
     * Evaluate the y value of the line for a given x value, using the equation y = mx + b.
     *
     * @param float $x
     * @return float
     */
    public function evaluate(float $x) : float
    {
        return $this->first()->getM() * $x + $this->first()->getB();
    }

    /**
     * Return the slope (m) of the line as a float.
     *
     * Slope will be a positive number (a rising slope), a negative number (a falling slope) or zero (flat).
     *
     * @return float
     */
    public function slope() : float
    {
        return $this->first()->getM();
    }
}
