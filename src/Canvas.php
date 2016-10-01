<?php

namespace Rimelek\Columns3D;


class Canvas
{
    const TYPE_JPEG = 'jpeg';
    const TYPE_PNG = 'png';
    const TYPE_GIF = 'gif';

    private $configuration;

    private $drawn = false;

    /**
     * @var PositionedElement[]
     */
    private $elements = [];

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

    private function draw()
    {
        if ($this->drawn) {
            return;
        }
        $source = $this->getSource();
        $color = imagecolorallocate($source, 0, 20, 30);
        imagefill($source, 0, 0, $color);

        foreach ($this->elements as $element) {
            $element->getDrawable()->draw($source, $element->getCenterX(), $element->getCenterY());
        }
        $this->elements = [];
        $this->drawn = true;
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

    public function show()
    {
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
    }
}