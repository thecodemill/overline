<?php

namespace TheCodeMill\Overline\Data;

interface PointContract
{
    /**
     * Instantiate a point statically.
     *
     * @param mixed $x
     * @param mixed $y
     * @return \TheCodeMill\Overline\Data\PointContract
     */
    public static function make($x = null, $y = null) : PointContract;

    /**
     * Set the x value.
     *
     * @param mixed $x
     * @return self
     */
    public function setX($x) : PointContract;

    /**
     * Return the x value.
     *
     * @return mixed
     */
    public function getX();

    /**
     * Set the y value.
     *
     * @param mixed $y
     * @return self
     */
    public function setY($y) : PointContract;

    /**
     * Return the y value.
     *
     * @return mixed
     */
    public function getY();

    /**
     * Return an array representation of the point.
     *
     * @return array
     */
    public function toArray() : array;
}
