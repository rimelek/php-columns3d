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
     * @param int $width
     * @param int $index
     * @return Color
     */
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

    /**
     * Generate all color of the gradient
     *
     * @param int $width
     * @return \Generator
     */
    public function generator(int $width)
    {
        for ($i = 0; $i < $width; $i++) {
            yield $this->calcColorAt($width, $i);
        }
    }
}