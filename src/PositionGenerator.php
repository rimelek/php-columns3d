<?php

namespace Rimelek\Columns3D;


class PositionGenerator
{
    private $step;
    private $radiusX;
    private $radiusY;

    public function __construct(int $radiusX, int $radiusY = null, int $step = 1)
    {
        if ($radiusY === null){
            $radiusY = $radiusX;
        }

        $this->step = $step;
        $this->radiusX = $radiusX;
        $this->radiusY = $radiusY;
    }

    public function __invoke(int $from, int $to)
    {
        for ($alpha = $from; $alpha <= $to; $alpha += $this->step) {
            yield [
                (cos(deg2rad($alpha)) * $this->radiusX),
                (sin(deg2rad($alpha)) * $this->radiusY),
            ];
        }
    }
}