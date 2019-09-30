<?php

namespace TheCodeMill\Overline\Indicators;

interface SettingContract
{
    /**
     * Set the default value fluently.
     *
     * @param mixed $default
     * @return self
     */
    public function default($default) : SettingContract;

    /**
     * Set the required flag fluently.
     *
     * @param bool $required
     * @return self
     */
    public function required(bool $required = true) : SettingContract;
}
