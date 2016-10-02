<?php

use Rimelek\Columns3D\Canvas;
use Rimelek\Columns3D\CanvasConfiguration as Conf;
use Rimelek\Columns3D\Drawable\GradientRectangle;
use Rimelek\Columns3D\Color;
use Rimelek\Columns3D\PositionedElement;

require '../vendor/autoload.php';

$canvas = new Canvas((new Conf())->setHeight(600)->setWidth(200)->setType(Canvas::TYPE_PNG));

$gradient = new GradientRectangle(new Color(80, 100, 200), new Color(180, 200, 0), 600);
$canvas->addElement(new PositionedElement($gradient, 0, 0));

$canvas->show();
