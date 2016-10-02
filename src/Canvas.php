<?php

namespace Rimelek\Columns3D;


class Canvas
{
    const TYPE_JPEG = 'jpeg';
    const TYPE_PNG = 'png';
    const TYPE_GIF = 'gif';

    /**
     * @var CanvasConfiguration
     */
    private $configuration;

    /**
     * @var bool
     */
    private $shown = false;

    /**
     * @var PositionedElement[]
     */
    private $elements = [];

    /**
     * Canvas constructor.
     * @param CanvasConfiguration $configuration
     */
    public function __construct(CanvasConfiguration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @param PositionedElement $element
     * @return $this
     */
    public function addElement(PositionedElement $element)
    {
        $this->elements[] = $element;
        return $this;
    }

    /**
     * Draw all of the added drawable elements
     */
    private function draw()
    {
        $source = $this->getSource();
        $color = $this->configuration->getColor();
        $allocatedColor = imagecolorallocate($source, $color->getRed(), $color->getGreen(), $color->getBlue());
        imagefill($source, 0, 0, $allocatedColor);

        foreach ($this->elements as $element) {
            $element->getDrawable()->draw($source, $element->getX(), $element->getY());
        }
        $this->elements = [];
    }

    /**
     * @return resource
     */
    private function getSource()
    {
        static $source;
        if (!$source) {
            $conf = $this->configuration;
            $source = imagecreatetruecolor($conf->getWidth(), $conf->getHeight());
        }
        return $source;
    }

    /**
     * Show the created image
     *
     * This method sets the 'Content-type' HTTP header
     *
     * This method is callable only once. The second call will do nothing.
     */
    public function show()
    {
        if ($this->shown) {
            return;
        }

        $type = $this->configuration->getType();

        if (!in_array($type, [self::TYPE_JPEG, self::TYPE_PNG, self::TYPE_GIF], true)) {
            $type = self::TYPE_GIF;
        }

        $this->draw();

        header("Content-type: image/" . $type);
        $func = 'image' . $type;
        if ($type === self::TYPE_JPEG) {
            $func($this->getSource(), null, $this->configuration->getQuality());
        } else {
            $func($this->getSource());
        }

        $this->shown = true;
    }
}