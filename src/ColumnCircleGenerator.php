<?php

namespace Rimelek\Columns3D;


class ColumnCircleGenerator
{
    private $positionGenerator;
    private $columnConfiguration;

    public function __construct(PositionGenerator $positionGenerator, ColumnConfiguration $columnConfiguration)
    {
        $this->positionGenerator = $positionGenerator;
        $this->columnConfiguration = $columnConfiguration;
    }

    public function __invoke(int $from, int $to, int $centerX, int $centerY)
    {
        $generator = $this->positionGenerator;
        foreach($generator($from, $to) as list($x, $y)) {
            yield new PositionedElement(new Column($this->columnConfiguration), $centerX + $x, $centerY + $y);
        }
    }
}