<?php

use Rimelek\Columns3D\Canvas;
use Rimelek\Columns3D\CanvasConfiguration as Conf;
use Rimelek\Columns3D\LinearGradient as Gradient;
use Rimelek\Columns3D\Color;

require '../vendor/autoload.php';

$canvas = new Canvas((new Conf())->setHeight(600)->setWidth(200)->setType(Canvas::TYPE_JPEG));

$pg = new Gradient(new Color(80, 100, 200), new Color(180, 200, 0));

foreach ($pg->generator(600) as $y => $color) {
    imageline($canvas->getSource(), 0, $y, 199, $y,
        imagecolorallocate($canvas->getSource(), $color->getRed(), $color->getGreen(), $color->getBlue()));
}

$canvas->show();
