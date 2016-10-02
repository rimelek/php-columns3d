<?php

namespace Rimelek\Columns3D\Drawable;

use Rimelek\Columns3D\Color;
use Rimelek\Columns3D\LinearGradient;

class GradientRectangle implements DrawableInterface
{
    /**
     * @var Color
     */
    private $start;

    /**
     * @var Color
     */
    private $end;

    /**
     * @var int
     */
    private $size;
    /**
     * GradientRectangle constructor.
     * @param Color $start
     * @param Color $end
     * @param int $size
     */
    public function __construct(Color $start, Color $end, int $size)
    {
        $this->start = $start;
        $this->end = $end;
        $this->size = $size;
    }

    /**
     * @param resource $source
     * @param int $cx
     * @param int $cy
     * @return mixed
     */
    public function draw($source, int $cx, int $cy)
    {
        $pg = new LinearGradient($this->start, $this->end);

        foreach ($pg->generator($this->size) as $y => $color) {
            imageline($source, 0, $y, 199, $y,
                imagecolorallocate($source, $color->getRed(), $color->getGreen(), $color->getBlue()));
        }
    }

}