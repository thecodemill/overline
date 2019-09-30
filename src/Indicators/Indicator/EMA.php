<?php

namespace TheCodeMill\Overline\Indicators\Indicator;

use MathPHP\Statistics\Average;
use TheCodeMill\Overline\Data\Series\Scalar;
use TheCodeMill\Overline\Data\SeriesContract;
use TheCodeMill\Overline\Indicators\Indicator;
use TheCodeMill\Overline\Indicators\Setting\Number;
use TheCodeMill\Overline\Data\Point\Scalar as ScalarPoint;

class EMA extends Indicator
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
            'length' => (new Number)->min(1)->max(1000)->default(14),
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
        $output = Scalar::make([]);

        $length = $this->getSetting('length');

        $values = $series->map(function ($point) {
            return $point->getY();
        });

        $ema = Average::exponentialMovingAverage($values, $length);

        foreach ($ema as $i => $y) {
            if ($xPoint = $series->offset($length + $i - 1)) {
                $output->append($output->getPointClass()::make($xPoint->getX(), $y));
            }
        }

        return $output;
    }
}
