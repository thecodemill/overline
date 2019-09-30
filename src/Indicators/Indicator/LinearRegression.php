<?php

namespace TheCodeMill\Overline\Indicators\Indicator;

use MathPHP\Statistics\Regression;
use TheCodeMill\Overline\Data\Series\Line;
use TheCodeMill\Overline\Data\Series\Scalar;
use TheCodeMill\Overline\Data\SeriesContract;
use TheCodeMill\Overline\Indicators\Indicator;
use TheCodeMill\Overline\Indicators\Setting\Number;

class LinearRegression extends Indicator
{
    /**
     * Expected input series base class.
     *
     * @var string
     */
    protected $inputSeriesClass = Scalar::class;

    /**
     * Return the indicator's supported settings.
     *
     * @return array
     */
    public function defineSettings() : array
    {
        return [
            'length' => (new Number)->min(1)->max(1000)->default(50),
        ];
    }

    /**
     * Handle the indicator calculation.
     *
     * @param \TheCodeMill\Overline\Data\SeriesContract $series
     * @return \TheCodeMill\Overline\Data\SeriesContract
     */
    protected function handle(SeriesContract $series) : SeriesContract
    {
        $output = Line::make([]);

        $length = $this->getSetting('length');

        $points = $series->slice(-$length, $length)->map(function ($point) {
            return [$point->getX(), $point->getY()];
        });

        $regression = new Regression\Linear($points);
        $parameters = $regression->getParameters();

        $point = $output->getPointClass()::make($series->last()->getX(), [
            'm' => $parameters['m'],
            'b' => $parameters['b'],
        ]);

        $output->append($point);

        return $output;
    }
}
