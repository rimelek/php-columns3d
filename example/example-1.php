<?php

use Rimelek\Columns3D\Column;
use Rimelek\Columns3D\Canvas;
use Rimelek\Columns3D\ColumnConfiguration;
use Rimelek\Columns3D\CanvasConfiguration;
use Rimelek\Columns3D\PositionedElement;
use Rimelek\Columns3D\PositionGenerator;
use Rimelek\Columns3D\ColumnCircleGenerator;
use Rimelek\Columns3D\StripedPattern;
use Rimelek\Columns3D\Color;
use Rimelek\Columns3D\LinearGradient;

require '../vendor/autoload.php';

const BIG_COLUMN_VERTICAL_ANGLE = 2 / 8;
const BIG_COLUMN_RADIUS_X = 130;
const BIG_COLUMN_RADIUS_Y = BIG_COLUMN_RADIUS_X * BIG_COLUMN_VERTICAL_ANGLE;

const SMALL_COLUMN_STEP = 20;
const SMALL_COLUMN_RADIUS_X = 10;
const SMALL_COLUMN_RADIUS_Y = SMALL_COLUMN_RADIUS_X * BIG_COLUMN_VERTICAL_ANGLE;
const SMALL_COLUMN_HEIGHT = 100;

const CENTER_X = 200;

$canvasConfiguration = (new CanvasConfiguration())
    ->setHeight(400)
    ->setWidth(400)
;
$canvas = new Canvas($canvasConfiguration);

$canvas->addElement(new PositionedElement(new StripedPattern(), $canvasConfiguration->getWidth() / 2, $canvasConfiguration->getHeight() / 2));

$bcc = (new ColumnConfiguration())
    ->setRadius(BIG_COLUMN_RADIUS_X)
    ->setVerticalAngle(BIG_COLUMN_VERTICAL_ANGLE)
    ->setHeight(200)
    ->setWallGradient(new LinearGradient(new Color(0, 56, 255), new Color(255, 56, 255)))
    ->setColor(new Color(126, 180, 255))
;
$bottomColumn = new Column($bcc);

$tcc = (new ColumnConfiguration())
    ->setRadius(BIG_COLUMN_RADIUS_X)
    ->setHeight(200 + BIG_COLUMN_RADIUS_Y)
    ->setVerticalAngle(BIG_COLUMN_VERTICAL_ANGLE)
    ->setWallGradient($bcc->getWallGradient())
    ->setColor($bcc->getColor())
;
$topColumn = new Column($tcc);

$canvas->addElement(new PositionedElement($bottomColumn, CENTER_X, 300));

$positionGenerator = new PositionGenerator(
    BIG_COLUMN_RADIUS_X - SMALL_COLUMN_RADIUS_X - 5,
    BIG_COLUMN_RADIUS_Y - SMALL_COLUMN_RADIUS_Y - 3, SMALL_COLUMN_STEP);

$scc = (new ColumnConfiguration())
    ->setRadius(SMALL_COLUMN_RADIUS_X)
    ->setHeight(SMALL_COLUMN_HEIGHT)
    ->setVerticalAngle(BIG_COLUMN_VERTICAL_ANGLE)
    ->setColor($bcc->getColor())
    ->setWallGradient(new LinearGradient(new Color(38, 174, 255), new Color(255, 173, 255)))
;

$behindColumnCircleGenerator = new ColumnCircleGenerator($positionGenerator, $scc);
foreach($behindColumnCircleGenerator(210, 360, CENTER_X, 200) as $e) {
    $canvas->addElement($e);
}

$frontColumnCircleGenerator = new ColumnCircleGenerator($positionGenerator,
        (clone $scc)->setWallGradient(new LinearGradient(new Color(13, 223, 255), new Color(255, 225, 255)))
);
foreach($frontColumnCircleGenerator(0, 160, CENTER_X, 200) as $e) {
    $canvas->addElement($e);
}

$canvas->addElement(new PositionedElement($topColumn, CENTER_X, -BIG_COLUMN_RADIUS_Y));

$canvas->show();

