<?php

namespace App\Helpers;

class ImageHelper
{
    public static function getThumbnailPath($imagePath)
    {
        if ($imagePath) {
            $directory = dirname($imagePath); 
            $filename = basename($imagePath); 

            return $directory . '/thumb/' . $filename;
        }
        return 'storage/no-image.jpg'; 
    }
}
