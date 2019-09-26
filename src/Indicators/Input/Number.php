<?php

namespace TheCodeMill\Overline\Indicators\Input;

use TheCodeMill\Overline\Indicators\Input;
use TheCodeMill\Overline\Indicators\InputContract;

class Number extends Input
{
    /**
     * Min value.
     *
     * @var float
     */
    public $min;

    /**
     * Max value.
     *
     * @var float
     */
    public $max;

    /**
     * Step distance.
     *
     * @var float
     */
    public $step = 1;

    /**
     * Set the min value fluently.
     *
     * @param float $min
     * @return self
     */
    public function min(float $min) : InputContract
    {
        $this->min = $min;

        return $this;
    }

    /**
     * Set the max value fluently.
     *
     * @param float $max
     * @return self
     */
    public function max(float $max) : InputContract
    {
        $this->max = $max;

        return $this;
    }

    /**
     * Set the step value fluently.
     *
     * @param float $step
     * @return self
     */
    public function step(float $step) : InputContract
    {
        $this->step = $step;

        return $this;
    }

    /**
     * Validate a value using the input constraints.
     *
     * @param mixed $value
     * @return bool
     */
    public function validate($value) : bool
    {
        if (!parent::validate($value)) {
            return false;
        }

        if (!is_numeric($value)) {
            return false;
        }

        if ($this->min !== null && $value < $this->min) {
            return false;
        }

        if ($this->max !== null && $value > $this->max) {
            return false;
        }

        if ($this->step != 0 && fmod($value, $this->step) != 0) {
            return false;
        }

        return true;
    }
}
