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
     * Return the indicator's supported settings.
     *
     * @return array
     */
    public function defineSettings() : array;

    /**
     * Return the settings value(s).
     *
     * @param string $key
     * @return array
     */
    public function getSetting(string $key = null);

    /**
     * Validate and set the indicator's settings value(s).
     *
     * @param array $values
     * @return self
     */
    public function setSetting(array $values) : IndicatorContract;

    /**
     * Compute the indicator's output and return as a series.
     *
     * @param \TheCodeMill\Overline\Data\SeriesContract $series
     * @return \TheCodeMill\Overline\Data\SeriesContract
     */
    public function compute(SeriesContract $series) : SeriesContract;
}
