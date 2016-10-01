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
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
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
     * @param int $quality
     * @return CanvasConfiguration
     */
    public function setQuality(int $quality): CanvasConfiguration
    {
        $this->quality = $quality;
        return $this;
    }

    /**
     * Width of the ellipse
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     *
     * @param int $width Width of the ellipse
     * @return CanvasConfiguration
     */
    public function setWidth(int $width): CanvasConfiguration
    {
        $this->width = $width;
        return $this;
    }

    /**
     * Height of the ellipse
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height Height of the ellipse
     * @return CanvasConfiguration
     */
    public function setHeight(int $height): CanvasConfiguration
    {
        $this->height = $height;
        return $this;
    }

}