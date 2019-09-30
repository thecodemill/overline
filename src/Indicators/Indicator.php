<?php

namespace TheCodeMill\Overline\Indicators;

use TheCodeMill\Overline\Data\SeriesContract;

abstract class Indicator implements IndicatorContract
{
    /**
     * Expected input series base class.
     *
     * @var string
     */
    protected $inputSeriesClass;

    /**
     * Indicator settings value(s).
     *
     * @var array
     */
    protected $settings = [];

    /**
     * Instatiate the indicator.
     *
     * @param array $settings
     * @return void
     */
    public function __construct(array $settings = [])
    {
        $this->setSetting($settings);
    }

    /**
     * Instantiate an indicator statically.
     *
     * @param array $settings
     * @return \TheCodeMill\Overline\Indicators\IndicatorContract
     */
    public static function make(array $settings = []) : IndicatorContract
    {
        return new static($settings);
    }

    /**
     * Return the expected input series base class.
     *
     * @return string
     * @throws \RuntimeException
     */
    public function getInputSeriesClass() : string
    {
        if (!$this->inputSeriesClass) {
            throw new \RuntimeException('Expected input series class not set');
        }

        return $this->inputSeriesClass;
    }

    /**
     * Return the indicator's supported settings.
     *
     * @return array
     */
    public function defineSettings() : array
    {
        return [];
    }

    /**
     * Return the settings value(s).
     *
     * @param string $key
     * @return array
     */
    public function getSetting(string $key = null)
    {
        if ($key !== null) {
            if (!array_key_exists($key, $this->settings)) {
                throw new \InvalidArgumentException(sprintf('Setting "%s" not defined', $key));
            }

            return $this->settings[$key];
        }

        return $this->settings;
    }

    /**
     * Validate and set the indicator's settings value(s).
     *
     * @param array $values
     * @return self
     * @throws \InvalidArgumentException
     */
    public function setSetting(array $values) : IndicatorContract
    {
        $this->settings = [];

        foreach ($this->defineSettings() as $key => $setting) {
            if (!$setting->validate($values[$key] ?? null)) {
                throw new \InvalidArgumentException(sprintf('Invalid setting: %s', $key));
            } else {
                $this->settings[$key] = $values[$key] ?? null;
            }
        }

        return $this;
    }

    /**
     * Compute the indicator's output and return as a series.
     *
     * @param \TheCodeMill\Overline\Data\SeriesContract $series
     * @return \TheCodeMill\Overline\Data\SeriesContract
     */
    public function compute(SeriesContract $series) : SeriesContract
    {
        if (!($series instanceof $this->inputSeriesClass)) {
            throw new \RuntimeException(sprintf(
                'Indicator can only compute for a %s input series',
                $this->inputSeriesClass
            ));
        }

        return $this->handle($series);
    }

    /**
     * Handle the indicator calculation.
     *
     * @param \TheCodeMill\Overline\Data\SeriesContract $series
     * @return \TheCodeMill\Overline\Data\SeriesContract
     */
    abstract protected function handle(SeriesContract $series) : SeriesContract;
}
