<?php

namespace Rimelek\Columns3D\Example;


use Rimelek\Columns3D\Canvas;
use Rimelek\Columns3D\CanvasConfiguration;
use Rimelek\Columns3D\Drawable\Column;
use Rimelek\Columns3D\Drawable\ColumnConfiguration;
use Rimelek\Columns3D\Generator\PositionGenerator;
use Rimelek\Columns3D\LinearGradient;
use Rimelek\Columns3D\PositionedElement;
use Rimelek\Columns3D\Color;

class BeHappy
{
    private $canvas;

    public function __construct()
    {
        $this->canvas = new Canvas((new CanvasConfiguration())
            ->setHeight(400)
            ->setWidth(400)
            ->setType(Canvas::TYPE_PNG)
        );

        $leftEye = $this->createEye(1);
        $rightEye = $this->createEye(0.4);

        $nose = $this->createNose();

        $leftEar = $this->createEar();
        $rightEar = $this->createEar();

        $mouth = $this->createMouth();

        $head = $this->createHead();

        $hair = $this->createHair();

        $this->canvas->addElement(new PositionedElement($head, 200, 200));
        $this->canvas->addElement(new PositionedElement($leftEye, 140, 120));
        $this->canvas->addElement(new PositionedElement($rightEye, 260, 120));
        $this->canvas->addElement(new PositionedElement($nose, 200, 180));
        $this->canvas->addElement(new PositionedElement($leftEar, 50, 160));
        $this->canvas->addElement(new PositionedElement($rightEar, 350, 160));
        $this->canvas->addElement(new PositionedElement($mouth, 200, 290));

        $positionGenerator = new PositionGenerator(150, 165, 3);
        foreach ($positionGenerator(-150, -30) as list($x, $y)) {
            $this->canvas->addElement(new PositionedElement($hair, 200 + $x, 200 + $y));
        }
    }

    private function createEye(float $vAngle = 1): Column
    {
        $eyeConf = (new ColumnConfiguration())
            ->setHeight(1)
            ->setRadius(10)
            ->setVerticalAngle($vAngle)
        ;
        return new Column($eyeConf);
    }

    private function createNose(): Column
    {
        $noseConf = (new ColumnConfiguration())
            ->setHeight(1)
            ->setRadius(5)
            ->setVerticalAngle(2)
        ;

        return new Column($noseConf);
    }

    private function createEar(): Column
    {
        $earConf = (new ColumnConfiguration())
            ->setHeight(1)
            ->setRadius(4)
            ->setVerticalAngle(2)
        ;

        return new Column($earConf);
    }

    private function createMouth(): Column
    {
        $mouthConf = (new ColumnConfiguration())
            ->setHeight(1)
            ->setRadius(50)
            ->setVerticalAngle(0.5)
            ->setColor(new Color(0, 0, 0))
            ->setWallGradient(new LinearGradient(new Color(255, 255, 255), new Color(255, 255, 0)))
        ;

        return new Column($mouthConf);
    }

    private function createHead(): Column
    {
        $headConf = (new ColumnConfiguration())
            ->setHeight(1)
            ->setRadius(150)
            ->setVerticalAngle(1.1)
        ;

        return new Column($headConf);
    }

    private function createHair(): Column
    {
        $hearConf = (new ColumnConfiguration())
            ->setHeight(1)
            ->setRadius(10)
            ->setVerticalAngle(1.1)
            ->setWallGradient(new LinearGradient(new Color(0, 0, 0), new Color(0, 0, 0)))
        ;
        return new Column($hearConf);
    }

    public function show()
    {
        $this->canvas->show();
    }
}