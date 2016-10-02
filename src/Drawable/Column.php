<?php

namespace Rimelek\Columns3D\Drawable;


class Column implements DrawableInterface
{
    /**
     * @var ColumnConfiguration
     */
    private $configuration;

    /**
     * Column constructor.
     * @param ColumnConfiguration $configuration
     */
    public function __construct(ColumnConfiguration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * Draw a column
     * @param resource $source Value returned by imagecreatetruecolor
     * @param int $cx Position of the column's center horizontally
     * @param int $cy Position of the center of the ellipse on top of the column vertically
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