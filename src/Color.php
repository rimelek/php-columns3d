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
    /**
     * Red component of RGB color
     *
     * @var int
     */
    private $red;

    /**
     * @var Green component of RGB color
     */
    private $green;

    /**
     * Blue component of RGB color
     *
     * @var int
     */
    private $blue;

    /**
     * Color constructor.
     *
     * When the value of red, green or blue is greater than 255 or lower than 0
     * that will be stored as |$value| mod 256
     *
     * @param int $red Red component of RGB Color
     * @param int $green Green component of RGB color
     * @param int $blue Blue component of RGB color
     */
    public function __construct(int $red, int $green, int $blue)
    {
        $this->red = abs($red) % 256;
        $this->green = abs($green) % 256;
        $this->blue = abs($blue) % 256;
    }

    /**
     * @return int Red component of RGB color
     */
    public function getRed(): int
    {
        return $this->red;
    }

    /**
     * @return mixed Green component of RGB color
     */
    public function getGreen(): int
    {
        return $this->green;
    }

    /**
     * @return mixed Blue component of RGB color
     */
    public function getBlue(): int
    {
        return $this->blue;
    }
}