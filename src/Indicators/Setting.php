<?php

namespace TheCodeMill\Overline\Indicators;

abstract class Setting implements SettingContract
{
    /**
     * Default value.
     *
     * @var mixed
     */
    public $default;

    /**
     * Required flag.
     *
     * @var bool
     */
    public $required = true;

    /**
     * Set the default value fluently.
     *
     * @param mixed $default
     * @return self
     */
    public function default($default) : SettingContract
    {
        $this->default = $default;

        return $this;
    }

    /**
     * Set the required flag fluently.
     *
     * @param bool $required
     * @return self
     */
    public function required(bool $required = true) : SettingContract
    {
        $this->required = $required;

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
        if ($this->required && !$value && $value !== '0' && $value !== 0) {
            return false;
        }

        return true;
    }
}
