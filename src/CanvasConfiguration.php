<?php

namespace Rimelek\Columns3D;


class CanvasConfiguration
{
    /**
     * @var string
     */
    private $type = Canvas::TYPE_GIF;

    /**
     * @var int
     */
    private $quality = 100;

    /**
     * @var int
     */

    private $width = 400;
    /**
     * @var int
     */
    private $height = 400;

    /**
     * @var Color
     */
    private $color = null;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type Valid values: {@link Canvas::TYPE_GIF}|{@link Canvas::TYPE_JPEG}|{@link Canvas::TYPE_PNG}
     * @return CanvasConfiguration
     */
    public function setType(string $type): CanvasConfiguration
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuality(): int
    {
        return $this->quality;
    }

    /**
     * @param int $quality Percent.
     * @return CanvasConfiguration
     */
    public function setQuality(int $quality): CanvasConfiguration
    {
        $this->quality = max(min($quality, 100), 0);
        return $this;
    }

    /**
     * Width of the canvas
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     *
     * @param int $width Width of the canvas
     * @return CanvasConfiguration
     */
    public function setWidth(int $width): CanvasConfiguration
    {
        $this->width = $width;
        return $this;
    }

    /**
     * Height of the canvas
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height Height of the canvas
     * @return CanvasConfiguration
     */
    public function setHeight(int $height): CanvasConfiguration
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @return Color
     */
    public function getColor(): Color
    {
        if ($this->color === null) {
            $this->setColor(new Color(0, 0, 0));
        }
        return $this->color;
    }

    /**
     * @param Color $color
     * @return CanvasConfiguration
     */
    public function setColor(Color $color): CanvasConfiguration
    {
        $this->color = $color;
        return $this;
    }


}