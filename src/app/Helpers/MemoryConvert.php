<?php

namespace App\Helpers;

class MemoryConvert
{
    /**
     * Format bytes to mb
     *
     * @param  integer $size
     * @return integer
     */
    public static function convertBytesToMb($fileSize)
    {
        return round($fileSize / 1024 / 1024, 4);
    }
}
