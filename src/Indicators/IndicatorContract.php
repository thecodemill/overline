<?php

namespace TheCodeMill\Overline\Indicators;

use TheCodeMill\Overline\Data\SeriesContract;

interface IndicatorContract
{
    /**
     * Return the expected input series base class.
     *
     * @return string
     */
    public function getInputSeriesClass() : string;

    /**
     * Return the indicator's supported inputs.
     *
     * @return array
     */
    public function defineInputs() : array;

    /**
     * Return the input value(s).
     *
     * @param string $key
     * @return array
     */
    public function getInput(string $key = null);

    /**
     * Validate and set the indicator's input value(s).
     *
     * @param array $values
     * @return self
     */
    public function setInput(array $values) : IndicatorContract;

    /**
     * Compute the indicator's output and return as a series.
     *
     * @param \TheCodeMill\Overline\Data\SeriesContract $series
     * @return \TheCodeMill\Overline\Data\SeriesContract
     */
    public function compute(SeriesContract $series) : SeriesContract;
}
