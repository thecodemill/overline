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
     * Indicator input value(s).
     *
     * @var array
     */
    protected $input = [];

    /**
     * Instatiate the indicator.
     *
     * @param array $input
     * @return void
     */
    public function __construct(array $input = [])
    {
        $this->setInput($input);
    }

    /**
     * Instantiate an indicator statically.
     *
     * @param array $input
     * @return \TheCodeMill\Overline\Indicators\IndicatorContract
     */
    public static function make(array $input = []) : IndicatorContract
    {
        return new static($input);
    }

    /**
     * Return the expected inpur series base class.
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
     * Return the indicator's supported inputs.
     *
     * @return array
     */
    public function defineInputs() : array
    {
        return [];
    }

    /**
     * Return the input value(s).
     *
     * @param string $key
     * @return array
     */
    public function getInput(string $key = null)
    {
        if ($key !== null) {
            if (!array_key_exists($key, $this->input)) {
                throw new \InvalidArgumentException(sprintf('Input "%s" not defined', $key));
            }

            return $this->input[$key];
        }

        return $this->input;
    }

    /**
     * Validate and set the indicator's input value(s).
     *
     * @param array $values
     * @return self
     * @throws \InvalidArgumentException
     */
    public function setInput(array $values) : IndicatorContract
    {
        $this->input = [];

        foreach ($this->defineInputs() as $key => $input) {
            if (!$input->validate($values[$key] ?? null)) {
                throw new \InvalidArgumentException(sprintf('Invalid input: %s', $key));
            } else {
                $this->input[$key] = $values[$key] ?? null;
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
