<?php

namespace Rimelek\Columns3D;


class Column implements DrawableInterface
{
    private $configuration;

    public function __construct(ColumnConfiguration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * Draw a column
     * @param resource $source
     * @param int $cx
     * @param int $cy
     */
    public function draw($source, int $cx, int $cy)
    {
        $conf = $this->configuration;

        $r = $conf->getRadius();
        $vAngle = $conf->getVerticalAngle();
        $height = $conf->getHeight();
        $width = $r * 2;

        $wallGradient = $conf->getWallGradient();

        for ($i = 0 - $r; $i <= $r; $i++) {
            $x = $cx + $i;
            $alpha = acos($i / $r);
            $y = $cy + (-sin($alpha) * $r) * $vAngle;
            $y2 = $y + $height;

            $color = $conf->getColor();
            $lineColor = imagecolorallocate($source, $color->getRed(), $color->getGreen(), $color->getBlue());
            imageline($source, $x, $y, $x, $y2, $lineColor);
        }


        for ($i = 0 - $r; $i <= $r; $i++) {
            $x = $cx + $i;
            $alpha = acos($i / $r);
            $y = $cy + (sin($alpha) * $r) * $vAngle;
            $y2 = $y + $height;

            $color = $wallGradient->calcColorAt($width, $i + $r);
            $lineColor = imagecolorallocate($source, $color->getRed(), $color->getGreen(), $color->getBlue());
            imageline($source, $x, $y, $x, $y2, $lineColor);
        }
    }
}