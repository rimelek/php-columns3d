<?php

namespace Rimelek\Columns3D;


class PositionedElement
{
    private $drawable;
    private $centerX;
    private $centerY;

    public function __construct(DrawableInterface $drawable, int $centerX, int $centerY)
    {
        $this->drawable = $drawable;
        $this->centerY = $centerY;
        $this->centerX = $centerX;
    }

    /**
     * @return DrawableInterface
     */
    public function getDrawable(): DrawableInterface
    {
        return $this->drawable;
    }

    /**
     * @return int
     */
    public function getCenterX(): int
    {
        return $this->centerX;
    }

    /**
     * @return int
     */
    public function getCenterY(): int
    {
        return $this->centerY;
    }


}