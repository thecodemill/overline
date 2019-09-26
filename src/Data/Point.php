<?php

namespace TheCodeMill\Overline\Data;

abstract class Point implements PointContract
{
    /**
     * The point's x value.
     *
     * @var mixed
     */
    protected $x;

    /**
     * The point's y value.
     *
     * @var mixed
     */
    protected $y;

    /**
     * Instantiate a new point, optionally with a given x and y value.
     *
     * @param mixed $x
     * @param mixed $y
     * @return void
     */
    public function __construct($x = null, $y = null)
    {
        if (!is_null($x)) {
            $this->setX($x);
        }

        if (!is_null($y)) {
            $this->setY($y);
        }
    }

    /**
     * Instantiate a point statically.
     *
     * @param mixed $x
     * @param mixed $y
     * @return \TheCodeMill\Overline\Data\PointContract
     */
    public static function make($x = null, $y = null) : PointContract
    {
        return new static($x, $y);
    }

    /**
     * Set the x value.
     *
     * @param mixed $x
     * @return self
     */
    public function setX($x) : PointContract
    {
        $this->x = $x;

        return $this;
    }

    /**
     * Return the x value.
     *
     * @return mixed
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Set the y value.
     *
     * @param mixed $y
     * @return self
     */
    public function setY($y) : PointContract
    {
        $this->y = $y;

        return $this;
    }

    /**
     * Return the y value.
     *
     * @return mixed
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * Magic getter.
     *
     * @param string $key
     * @return mixed
     */
    public function __get(string $key)
    {
        $method = 'get' . ucfirst($key);

        if (method_exists($this, $method)) {
            return $this->$method();
        }
    }

    /**
     * Magic setter.
     *
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    public function __set(string $key, $value)
    {
        $method = 'set' . ucfirst($key);

        if (method_exists($this, $method)) {
            return $this->$method($value);
        }
    }

    /**
     * Return an array representation of the point.
     *
     * @return array
     */
    public function toArray() : array
    {
        return [
            'x' => $this->getX(),
            'y' => $this->getY(),
        ];
    }
}
