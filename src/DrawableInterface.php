<?php

namespace Rimelek\Columns3D;


interface DrawableInterface
{
    /**
     * @param $source
     * @param int $cx
     * @param int $cy
     * @return void
     */
    public function draw($source, int $cx, int $cy);
}