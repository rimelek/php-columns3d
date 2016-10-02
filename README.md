# Description

Using this library you can create images of different type of columns. 
If you use linear gradient on the column's wall, you can draw 3D-like shapes.
It is mainly just for fun and learn algorithms used by the library.

See some examples: [examples.md](example/examples.md)

# Installation

    php composer.phar require rimelek/columns3d:2.*
    
# Requirements

- PHP >= 7.0
- GD extension

# Usage

## Drawable elements

To start drawing you need to define a canvas

    use Rimelek\Columns3D\Canvas;
    use Rimelek\Columns3D\CanvasConfiguration;
    use Rimelek\Columns3D\Color;
    
    $cc = new CanvasConfiguration();
    $cc->setHeight(300);
    $cc->setWidth(300);
    $cc->setType(Canvas::TYPE_JPEG); //Canvas::TYPE_PNG and Canvas::TYPE_GIF are also supported
    $cc->setQuality(50); // Only in case of JPEG
    $cc->setColor(new Color(255, 0, 0)); //RGB
    
    $canvas = new Canvas($cc);
    
All methods of CanvasConfiguration are optional.
    
You can add elements to the canvas with addElement().

    use Rimelek\Columns3D\PositionedElement;

    // ...

    $canvas->addElement(new Positionedelement($drawable, /*x*/ 200, /*y*/ 200));
    
$drawable object must implement Rimelek\Columns3D\Drawable\DrawableInterface
 
Currently 2 classes are available:

**StripedPattern**

This is to add a striped background. For now, it does not support customization.

    use Rimelek\Columns3D\Drawable\StripedPattern;
    
    // ...
    
    $background = new StripedPattern();
    $canvas->addElement(new Positionedelement($background, 150, 150)); // background and the center of the canvas

**Column**

    use Rimelek\Columns3D\Drawable\Column;
    use Rimelek\Columns3D\Drawable\ColumnConfiguration;
    use Rimelek\Columns3D\LinearGradient;
    
    // ...
    
    $colc = new ColumnConfiguration();
    $colc->setRadius(100);
    $colc->setVeticalAngle(0.2); //This is for 3D. Define it between 0 and 1. Greater values mean you look at the column from higher.
    $colc->setHeigh(300);
    $colc->setWallGradient(new LinearGradient(new Color(0, 0, 0), new Color(255, 255, 255))); 
    $colc->setColor(new Color(200 200, 200));
    
    $column = new Column($colc);
    $canvas->addElement(new PositionedElement($column, 200, 200));

All methods of ColumnConfiguration are optional.


## Generator classes
 
There are two generator classes too.

**PositionGenerator**

It is to generate positions of an ellipse to use it in a foreach loop.

    $positionGenerator = new PositionGenerator($centerX, $centerY, $step /* Default is 1*/);
    foreach ($positionGenerator->call(/* start degree*/ -150, /* end degree */ -30) as list($x, $y)) {
        $this->addElement(new PositionedElement($drawable, 200 + $x, 200 + $y));
    }

**ColumnCircleGenerator**

Itt uses PositionGenerator to generate circle made of columns.

    $columnCircleGenerator = new ColumnCircleGenerator($positionGenerator, $columnConfiguration);
    foreach($columnCircleGenerator->call(/*degree*/$from, /*degree*/$to, $centerX, $centerY) as $e) {
        $canvas->addElement($e);
    }

