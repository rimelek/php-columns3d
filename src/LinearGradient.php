<?php

namespace Rimelek\Columns3D;


class LinearGradient
{
    private $start;
    private $end;

    public function __construct(Color $start, Color $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    private function calcRedStep(int $width): float
    {
        return ($this->end->getRed() - $this->start->getRed()) / $width;
    }

    private function calcGreenStep(int $width): float
    {
        return ($this->end->getGreen() - $this->start->getGreen()) / $width;
    }

    private function calcBlueStep(int $width): float
    {
        return ($this->end->getBlue() - $this->start->getBlue()) / $width;
    }

    public function calcColorAt(int $width, int $index): Color
    {
        $rs = $this->calcRedStep($width);
        $gs = $this->calcGreenStep($width);
        $bs = $this->calcBlueStep($width);

        return new Color(
            round($this->start->getRed() + ($rs * $index)),
            round($this->start->getGreen() + ($gs * $index)),
            round($this->start->getBlue() + ($bs * $index))
        );
    }
}