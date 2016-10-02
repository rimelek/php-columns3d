<?php

namespace Rimelek\Columns3D\Generator;

use Rimelek\Columns3D\Drawable\Column;
use Rimelek\Columns3D\Drawable\ColumnConfiguration;
use Rimelek\Columns3D\PositionedElement;

class ColumnCircleGenerator
{
    /**
     * @var PositionGenerator
     */
    private $positionGenerator;

    /**
     * @var ColumnConfiguration
     */
    private $columnConfiguration;

    /**
     * ColumnCircleGenerator constructor.
     * @param PositionGenerator $positionGenerator
     * @param ColumnConfiguration $columnConfiguration
     */
    public function __construct(PositionGenerator $positionGenerator, ColumnConfiguration $columnConfiguration)
    {
        $this->positionGenerator = $positionGenerator;
        $this->columnConfiguration = $columnConfiguration;
    }

    /**
     * @see call
     * @return \Generator
     */
    public function __invoke()
    {
        yield from call_user_func_array([$this, 'call'], func_get_args());
    }

    /**
     * @param int $from start degree
     * @param int $to end degree
     * @param int $centerX Center of the circle horizontally
     * @param int $centerY Center of the circle vertically
     * @return \Generator
     */
    public function call(int $from, int $to, int $centerX, int $centerY)
    {
        $generator = $this->positionGenerator;
        foreach($generator($from, $to) as list($x, $y)) {
            yield new PositionedElement(new Column($this->columnConfiguration), $centerX + $x, $centerY + $y);
        }
    }
}