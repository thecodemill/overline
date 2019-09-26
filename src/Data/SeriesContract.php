<?php

namespace TheCodeMill\Overline\Data;

interface SeriesContract
{
    /**
     * Instantiate a series statically.
     *
     * @param array $points
     * @return \TheCodeMill\Overline\Data\SeriesContract
     */
    public static function make(array $input = []) : SeriesContract;

    /**
     * Return the expected point base class.
     *
     * @return string
     */
    public function getPointClass() : string;

    /**
     * Return the maximum number of points allowed in the series.
     *
     * @return int
     */
    public function getMaxPoints() : int;

    /**
     * Set all the points at once.
     *
     * @param array $points
     * @return self
     */
    public function setPoints(array $points) : SeriesContract;

    /**
     * Return all the points in the series.
     *
     * @return array
     */
    public function getPoints() : array;

    /**
     * Count the number of points in the series.
     *
     * @return int
     */
    public function count() : int;

    /**
     * Sort the series into ascending order.
     *
     * @return self
     */
    public function sortAsc() : SeriesContract;

    /**
     * Sort the series into descending order.
     *
     * @return self
     */
    public function sortDesc() : SeriesContract;

    /**
     * Append a point to the series.
     *
     * @param \TheCodeMill\Overline\Data\PointContract $point
     * @return self
     */
    public function append(PointContract $point) : SeriesContract;

    /**
     * Prepend a point to the series.
     *
     * @param \TheCodeMill\Overline\Data\PointContract $point
     * @return self
     */
    public function prepend(PointContract $point) : SeriesContract;

    /**
     * Return a single point by offset in the series.
     *
     * @param int $offset
     * @return \TheCodeMill\Overline\Data\PointContract|null
     */
    public function offset(int $offset) : ?PointContract;

    /**
     * Return the first point in the series.
     *
     * Alias for static::offset(0).
     *
     * @return \TheCodeMill\Overline\Data\PointContract|null
     */
    public function first() : ?PointContract;

    /**
     * Return the last point in the series.
     *
     * Alias for static::offset(-1).
     *
     * @return \TheCodeMill\Overline\Data\PointContract|null
     */
    public function last() : ?PointContract;

    /**
     * Return a quantity of points by offset.
     *
     * @param int $offset
     * @param int $length
     * @return \TheCodeMill\Overline\Data\SeriesContract
     */
    public function slice(int $offset, int $length = null) : SeriesContract;

    /**
     * Map the series points into an array using a callback.
     *
     * @param callable $callback
     * @return array
     */
    public function map(callable $callback) : array;
}
