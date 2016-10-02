<?php

namespace Rimelek\Columns3D;


interface DrawableInterface
{
    /**
     * @param resource $source Value returned by imagecreatetruecolor
     * @param int $cx Reference point of the drawable element horizontally
     * @param int $cy Reference point of the drawable element vertically
     * @return void
     */
    public function draw($source, int $cx, int $cy);
}