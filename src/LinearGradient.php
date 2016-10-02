<?php

namespace Rimelek\Columns3D;


class LinearGradient
{
    /**
     * @var Color
     */
    private $start;

    /**
     * @var Color
     */
    private $end;

    /**
     * LinearGradient constructor.
     * @param Color $start
     * @param Color $end
     */
    public function __construct(Color $start, Color $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    /**
     * @param int $width
     * @return float
     */
    private function calcRedStep(int $width): float
    {
        return ($this->end->getRed() - $this->start->getRed()) / $width;
    }

    /**
     * @param int $width
     * @return float
     */
    private function calcGreenStep(int $width): float
    {
        return ($this->end->getGreen() - $this->start->getGreen()) / $width;
    }

    /**
     * @param int $width
     * @return float
     */
    private function calcBlueStep(int $width): float
    {
        return ($this->end->getBlue() - $this->start->getBlue()) / $width;
    }

    /**
     * @param int $size
     * @param int $index
     * @return Color
     */
    public function calcColorAt(int $size, int $index): Color
    {
        $rs = $this->calcRedStep($size);
        $gs = $this->calcGreenStep($size);
        $bs = $this->calcBlueStep($size);

        return new Color(
            round($this->start->getRed() + ($rs * $index)),
            round($this->start->getGreen() + ($gs * $index)),
            round($this->start->getBlue() + ($bs * $index))
        );
    }

    /**
     * Generate all color of the gradient
     *
     * @param int $size
     * @return \Generator|Color[]
     */
    public function generator(int $size)
    {
        for ($i = 0; $i < $size; $i++) {
            yield $this->calcColorAt($size, $i);
        }
    }
}