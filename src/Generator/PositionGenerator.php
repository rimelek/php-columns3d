<?php

namespace Rimelek\Columns3D\Generator;


class PositionGenerator
{
    /**
     * @var int
     */
    private $step;

    /**
     * @var int
     */
    private $radiusX;

    /**
     * @var int
     */
    private $radiusY;

    /**
     * PositionGenerator constructor.
     * @param int $radiusX
     * @param int|null $radiusY In case of null, the value will be the same as $radiusX
     * @param int $step
     */
    public function __construct(int $radiusX, int $radiusY = null, int $step = 1)
    {
        if ($radiusY === null){
            $radiusY = $radiusX;
        }

        $this->step = $step;
        $this->radiusX = $radiusX;
        $this->radiusY = $radiusY;
    }

    /**
     * @param int $from Start degree
     * @param int $to End degree
     * @return \Generator
     */
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