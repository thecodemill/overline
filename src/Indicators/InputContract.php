<?php

namespace TheCodeMill\Overline\Indicators;

interface InputContract
{
    /**
     * Set the default value fluently.
     *
     * @param mixed $default
     * @return self
     */
    public function default($default) : InputContract;

    /**
     * Set the required flag fluently.
     *
     * @param bool $required
     * @return self
     */
    public function required(bool $required = true) : InputContract;
}
