<?php

namespace TheCodeMill\Overline\Data\Point;

use TheCodeMill\Overline\Data\Point;
use TheCodeMill\Overline\Data\PointContract;

class Line extends Point
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
            throw new \InvalidArgumentException('Line y value must be an array of M and B parameters');
        }

        $m = $y['m'] ?? $y[0] ?? false;
        $b = $y['b'] ?? $y[1] ?? false;

        if ($m === false || $b === false) {
            throw new \InvalidArgumentException('Incomplete Line y value');
        }

        $this->y = compact('m', 'b');

        return $this;
    }

    /**
     * Return the m value.
     *
     * @return float
     */
    public function getM() : float
    {
        return $this->y['m'];
    }

    /**
     * Set the m value.
     *
     * @param float $m
     * @return self
     */
    public function setO(float $m) : PointContract
    {
        $this->y['m'] = $m;

        return $this;
    }

    /**
     * Return the b value.
     *
     * @return float
     */
    public function getB()
    {
        return $this->y['b'];
    }

    /**
     * Set the b value.
     *
     * @param float $b
     * @return self
     */
    public function setB(float $b) : PointContract
    {
        $this->y['b'] = $b;

        return $this;
    }
}
