<?php

namespace Rimelek\Columns3D;


class ColumnConfiguration
{
    private $radius = 150;

    private $height = 300;

    private $verticalAngle = 0.125;

    private $wallGradient = null;

    private $color = null;

    /**
     * @return int
     */
    public function getRadius(): int
    {
        return $this->radius;
    }

    /**
     * @param int $radius
     * @return ColumnConfiguration
     */
    public function setRadius(int $radius): ColumnConfiguration
    {
        $this->radius = $radius;
        return $this;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     * @return ColumnConfiguration
     */
    public function setHeight(int $height): ColumnConfiguration
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @return float
     */
    public function getVerticalAngle(): float
    {
        return $this->verticalAngle;
    }

    /**
     * @param float $verticalAngle
     * @return ColumnConfiguration
     */
    public function setVerticalAngle(float $verticalAngle): ColumnConfiguration
    {
        $this->verticalAngle = $verticalAngle;
        return $this;
    }

    /**
     * @return LinearGradient
     */
    public function getWallGradient(): LinearGradient
    {
        if ($this->wallGradient === null) {
            $this->setWallGradient(new LinearGradient(new Color(0, 0, 0), new Color(255, 0, 0)));
        }
        return $this->wallGradient;
    }

    /**
     * @param LinearGradient $wallGradient
     * @return ColumnConfiguration
     */
    public function setWallGradient(LinearGradient $wallGradient)
    {
        $this->wallGradient = $wallGradient;
        return $this;
    }

    /**
     * @return Color
     */
    public function getColor(): Color
    {
        if ($this->color === null) {
            $this->setColor(new Color(200, 255, 100));
        }
        return $this->color;
    }

    /**
     * @param Color $color
     * @return ColumnConfiguration
     */
    public function setColor(Color $color)
    {
        $this->color = $color;
        return $this;
    }

}