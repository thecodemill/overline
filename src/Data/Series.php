<?php

namespace TheCodeMill\Overline\Data;

abstract class Series implements SeriesContract
{
    /**
     * Expected point base class.
     *
     * @var string
     */
    protected $pointClass;

    /**
     * All the points in the series.
     *
     * @var array
     */
    protected $points = [];

    /**
     * Maximum number of points allowed.
     *
     * @var int
     */
    protected $maxPoints = 0;

    /**
     * Instantiate a new series, optionally including a set of points.
     *
     * @param array $points
     * @return void
     */
    public function __construct(array $points = [])
    {
        $this->pointClass = $this->getPointClass();

        $this->setPoints($points);
    }

    /**
     * Instantiate a series statically.
     *
     * @param array $points
     * @return \TheCodeMill\Overline\Data\SeriesContract
     */
    public static function make(array $input = []) : SeriesContract
    {
        return new static($input);
    }

    /**
     * Return the expected point base class.
     *
     * @return string
     * @throws \RuntimeException
     */
    public function getPointClass() : string
    {
        if (!$this->pointClass) {
            throw new \RuntimeException('Series expected point class not set');
        }

        return $this->pointClass;
    }

    /**
     * Verify that a point is valid to be included in the series.
     *
     * @param \TheCodeMill\Overline\Data\PointContract $point
     * @return void
     * @throws \RuntimeException
     */
    protected function validatePoint(PointContract $point) : void
    {
        if (!($point instanceof $this->pointClass)) {
            throw new \RuntimeException(sprintf(
                'Point of type %s not compatible with series %s. Expected %s.',
                get_class($point),
                __CLASS__,
                $this->getPointClass()
            ));
        }
    }

    /**
     * Verify that the series will allow more points to be added.
     *
     * @return void
     * @throws \RuntimeException
     */
    protected function validateMaxPoints() : void
    {
        if ($this->isFull()) {
            throw new \RuntimeException(sprintf('The series does not accept more than %d points.', $this->maxPoints));
        }
    }

    /**
     * Return the maximum number of points allowed in the series.
     *
     * @return int
     */
    public function getMaxPoints() : int
    {
        return $this->maxPoints;
    }

    /**
     * Set all the points at once.
     *
     * Accepted argument can be either an array of point instances (conforming to the expected point class) or an array
     * of raw point x/y data.
     *
     * Raw x/y data should be in the form of an [[x1, y1], [x2, y2], [xN, yN]…] array,
     *
     * @param array $points
     * @return self
     */
    public function setPoints(array $points) : SeriesContract
    {
        $this->points = [];

        $pointClass = $this->getPointClass();

        foreach ($points as $point) {
            if (is_array($point)) {
                list ($x, $y) = array_values($point);
                $point = new $pointClass($x, $y);
            }

            $this->append($point);
        }

        return $this;
    }

    /**
     * Return all the points in the series.
     *
     * @return array
     */
    public function getPoints() : array
    {
        return $this->points;
    }

    /**
     * Alias for static::getPoints().
     *
     * @return array
     */
    public function all() : array
    {
        return $this->getPoints();
    }

    /**
     * Count the number of points in the series.
     *
     * @return int
     */
    public function count() : int
    {
        return count($this->points);
    }

    /**
     * Sort the series into ascending order.
     *
     * @return self
     */
    public function sortAsc() : SeriesContract
    {
        usort($this->points, [$this, 'sortPoints']);

        return $this;
    }

    /**
     * Sort the series into descending order.
     *
     * @return self
     */
    public function sortDesc() : SeriesContract
    {
        $this->points = array_reverse($this->sortAsc()->all());

        return $this;
    }

    /**
     * Compare two points to determine which one has the greater x value.
     *
     * @param \TheCodeMill\Overline\Data\PointContract $a
     * @param \TheCodeMill\Overline\Data\PointContract $b
     * @return int
     */
    protected function sortPoints(PointContract $a, PointContract $b) : int
    {
        $aX = is_numeric($a->getX()) ? (float) $a->getX() : (string) $a->getX();
        $bX = is_numeric($b->getX()) ? (float) $b->getX() : (string) $b->getX();

        if ($aX == $bX) {
            return 0;
        }

        return $aX > $bX ? 1 : -1;
    }

    /**
     * Check whether the series is full.
     *
     * @return bool
     */
    public function isFull() : bool
    {
        return $this->getMaxPoints() > 0 && $this->count() >= $this->getMaxPoints();
    }

    /**
     * Check whether the series will accommodate more points.
     *
     * @return bool
     */
    public function isNotFull() : bool
    {
        return !$this->isFull();
    }

    /**
     * Append a point to the series.
     *
     * @param \TheCodeMill\Overline\Data\PointContract $point
     * @return self
     */
    public function append(PointContract $point) : SeriesContract
    {
        $this->validateMaxPoints();
        $this->validatePoint($point);

        array_push($this->points, $point);

        return $this;
    }

    /**
     * Prepend a point to the series.
     *
     * @param \TheCodeMill\Overline\Data\PointContract $point
     * @return self
     */
    public function prepend(PointContract $point) : SeriesContract
    {
        $this->validateMaxPoints();
        $this->validatePoint($point);

        array_unshift($this->points, $point);

        return $this;
    }

    /**
     * Return a single point by offset in the series.
     *
     * @param int $offset
     * @return \TheCodeMill\Overline\Data\PointContract|null
     */
    public function offset(int $offset) : ?PointContract
    {
        return array_slice($this->points, $offset, 1)[0] ?? null;
    }

    /**
     * Return the first point in the series.
     *
     * Alias for static::offset(0).
     *
     * @return \TheCodeMill\Overline\Data\PointContract|null
     */
    public function first() : ?PointContract
    {
        return $this->offset(0);
    }

    /**
     * Return the last point in the series.
     *
     * Alias for static::offset(-1).
     *
     * @return \TheCodeMill\Overline\Data\PointContract|null
     */
    public function last() : ?PointContract
    {
        return $this->offset(-1);
    }

    /**
     * Return a quantity of points by offset.
     *
     * @param int $offset
     * @param int $length
     * @return \TheCodeMill\Overline\Data\SeriesContract
     */
    public function slice(int $offset, int $length = null) : SeriesContract
    {
        $points = array_slice($this->points, $offset, $length);

        return new static($points);
    }

    /**
     * Map the series points into an array using a callback.
     *
     * @param callable $callback
     * @return array
     */
    public function map(callable $callback) : array
    {
        return array_map($callback, $this->getPoints());
    }
}
