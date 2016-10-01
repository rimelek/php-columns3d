<?php
/**
 * Created by PhpStorm.
 * User: phppr
 * Date: 2016-10-01
 * Time: 20:10
 */

namespace Rimelek\Columns3D;


class Color
{
    private $red;
    private $green;
    private $blue;

    public function __construct(int $red, int $green, int $blue)
    {
        $this->red = $red;
        $this->green = $green;
        $this->blue = $blue;
    }

    /**
     * @return mixed
     */
    public function getRed(): int
    {
        return $this->red;
    }

    /**
     * @return mixed
     */
    public function getGreen(): int
    {
        return $this->green;
    }

    /**
     * @return mixed
     */
    public function getBlue(): int
    {
        return $this->blue;
    }
}