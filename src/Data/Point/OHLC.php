<?php

namespace TheCodeMill\Overline\Data\Point;

use TheCodeMill\Overline\Data\Point;
use TheCodeMill\Overline\Data\PointContract;

class OHLC extends Point
{
    /**
     * Set the y value.
     *
     * @param mixed $y
     * @return self
     * @throws \InvalidArgumentException
     */
    public function setY($y) : PointContract
    {
        if (!is_array($y)) {
            throw new \InvalidArgumentException('OHLC y value must be an array');
        }

        $o = $y['o'] ?? $y[0] ?? false;
        $h = $y['h'] ?? $y[1] ?? false;
        $l = $y['l'] ?? $y[2] ?? false;
        $c = $y['c'] ?? $y[3] ?? false;

        if ($o === false || $h === false || $l === false || $c === false) {
            throw new \InvalidArgumentException('Incomplete OHLC y value');
        }

        $this->y = compact('o', 'h', 'l', 'c');

        return $this;
    }

    /**
     * Return the o value.
     *
     * @return mixed
     */
    public function getO()
    {
        return $this->y['o'];
    }

    /**
     * Set the o value.
     *
     * @param mixed $o
     * @return self
     */
    public function setO($o) : PointContract
    {
        $this->y['o'] = $o;

        return $this;
    }

    /**
     * Return the h value.
     *
     * @return mixed
     */
    public function getH()
    {
        return $this->y['h'];
    }

    /**
     * Set the h value.
     *
     * @param mixed $h
     * @return self
     */
    public function setH($h) : PointContract
    {
        $this->y['h'] = $h;

        return $this;
    }

    /**
     * Return the l value.
     *
     * @return mixed
     */
    public function getL()
    {
        return $this->y['l'];
    }

    /**
     * Set the l value.
     *
     * @param mixed $l
     * @return self
     */
    public function setL($l) : PointContract
    {
        $this->y['l'] = $l;

        return $this;
    }

    /**
     * Return the c value.
     *
     * @return mixed
     */
    public function getC()
    {
        return $this->y['c'];
    }

    /**
     * Set the c value.
     *
     * @param mixed $c
     * @return self
     */
    public function setC($c) : PointContract
    {
        $this->y['c'] = $c;

        return $this;
    }
}
