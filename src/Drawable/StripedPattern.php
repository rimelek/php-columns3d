<?php

namespace Rimelek\Columns3D\Drawable;


class StripedPattern implements DrawableInterface
{
    /**
     * @param resource $source
     * @param int $cx
     * @param int $cy
     */
    public function draw($source, int $cx, int $cy)
    {
        $width = $cx * 2;
        $height = $cy * 2;

        $blue = 200;
        $red = 0;
        $green = 20;

        $offset = 255 / 2 * $width;

        for ($i = 0; $i <= 4 * $height; $i++) {
            $x1 = 0;
            $y1 = (0 - $height) + $i;
            $x2 = $width;
            $y2 = $y1 + $height;

            $color = imagecolorallocate($source, $red, $green, $blue);
            imageline($source, $x1, $y1, $x2, $y2, $color);
            $red = $red + $offset;
        }
    }

}