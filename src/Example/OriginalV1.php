<?php

namespace Rimelek\Columns3D\Example;


use Rimelek\Columns3D\Canvas;
use Rimelek\Columns3D\CanvasConfiguration;
use Rimelek\Columns3D\LinearGradient;
use Rimelek\Columns3D\Color;
use Rimelek\Columns3D\Drawable\Column;
use Rimelek\Columns3D\Drawable\ColumnConfiguration;
use Rimelek\Columns3D\Generator\PositionGenerator;
use Rimelek\Columns3D\Generator\ColumnCircleGenerator;
use Rimelek\Columns3D\PositionedElement;
use Rimelek\Columns3D\Drawable\StripedPattern;

class OriginalV1
{

    const BIG_COLUMN_VERTICAL_ANGLE = 2 / 8;
    const BIG_COLUMN_RADIUS_X = 130;
    const BIG_COLUMN_RADIUS_Y = self::BIG_COLUMN_RADIUS_X * self::BIG_COLUMN_VERTICAL_ANGLE;

    const SMALL_COLUMN_RADIUS_X = 10;
    const SMALL_COLUMN_RADIUS_Y = self::SMALL_COLUMN_RADIUS_X * self::BIG_COLUMN_VERTICAL_ANGLE;
    const SMALL_COLUMN_HEIGHT = 100;

    const COLUMN_CIRCLE_STEP = 20;

    const CENTER_X = 200;


    /**
     * @var Canvas
     */
    private $canvas;

    public function __construct()
    {
        $canvasConfiguration = (new CanvasConfiguration())
            ->setHeight(400)
            ->setWidth(400)
        ;
        $canvas = new Canvas($canvasConfiguration);

        $canvas->addElement(new PositionedElement(new StripedPattern(), $canvasConfiguration->getWidth() / 2, $canvasConfiguration->getHeight() / 2));

        $bcc = (new ColumnConfiguration())
            ->setRadius(self::BIG_COLUMN_RADIUS_X)
            ->setVerticalAngle(self::BIG_COLUMN_VERTICAL_ANGLE)
            ->setHeight(200)
            ->setWallGradient(new LinearGradient(new Color(0, 56, 255), new Color(255, 56, 255)))
            ->setColor(new Color(126, 180, 255))
        ;
        $bottomColumn = new Column($bcc);

        $tcc = (new ColumnConfiguration())
            ->setRadius(self::BIG_COLUMN_RADIUS_X)
            ->setHeight(200 + self::BIG_COLUMN_RADIUS_Y)
            ->setVerticalAngle(self::BIG_COLUMN_VERTICAL_ANGLE)
            ->setWallGradient($bcc->getWallGradient())
            ->setColor($bcc->getColor())
        ;
        $topColumn = new Column($tcc);

        $canvas->addElement(new PositionedElement($bottomColumn, self::CENTER_X, 300));

        $positionGenerator = new PositionGenerator(
            self::BIG_COLUMN_RADIUS_X - self::SMALL_COLUMN_RADIUS_X - 5,
            self::BIG_COLUMN_RADIUS_Y - self::SMALL_COLUMN_RADIUS_Y - 3, self::COLUMN_CIRCLE_STEP);

        $scc = (new ColumnConfiguration())
            ->setRadius(self::SMALL_COLUMN_RADIUS_X)
            ->setHeight(self::SMALL_COLUMN_HEIGHT)
            ->setVerticalAngle(self::BIG_COLUMN_VERTICAL_ANGLE)
            ->setColor($bcc->getColor())
            ->setWallGradient(new LinearGradient(new Color(38, 174, 255), new Color(255, 173, 255)))
        ;

        foreach((new ColumnCircleGenerator($positionGenerator, $scc))->call(210, 360, self::CENTER_X, 200) as $e) {
            $canvas->addElement($e);
        }

        $frontColumnCircleGenerator = new ColumnCircleGenerator($positionGenerator,
            (clone $scc)->setWallGradient(new LinearGradient(new Color(13, 223, 255), new Color(255, 225, 255)))
        );
        foreach($frontColumnCircleGenerator->call(0, 160, self::CENTER_X, 200) as $e) {
            $canvas->addElement($e);
        }

        $canvas->addElement(new PositionedElement($topColumn, self::CENTER_X, -self::BIG_COLUMN_RADIUS_Y));

        $this->canvas = $canvas;
    }

    public function show()
    {
        $this->canvas->show();
    }
}