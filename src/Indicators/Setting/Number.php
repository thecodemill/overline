<?php

namespace TheCodeMill\Overline\Indicators\Setting;

use TheCodeMill\Overline\Indicators\Setting;
use TheCodeMill\Overline\Indicators\SettingContract;

class Number extends Setting
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
    public function min(float $min) : SettingContract
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
    public function max(float $max) : SettingContract
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
    public function step(float $step) : SettingContract
    {
        $this->step = $step;

        return $this;
    }

    /**
     * Validate a value using the setting constraints.
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
