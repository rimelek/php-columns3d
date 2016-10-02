<?php

namespace Rimelek\Columns3D;


use Rimelek\Columns3D\Drawable\DrawableInterface;

class PositionedElement
{
    /**
     * @var DrawableInterface
     */
    private $drawable;

    /**
     * @var int
     */
    private $x;

    /**
     * @var int
     */
    private $y;

    /**
     * PositionedElement constructor.
     * @param DrawableInterface $drawable
     * @param int $x
     * @param int $y
     */
    public function __construct(DrawableInterface $drawable, int $x, int $y)
    {
        $this->drawable = $drawable;
        $this->y = $y;
        $this->x = $x;
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
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }


}