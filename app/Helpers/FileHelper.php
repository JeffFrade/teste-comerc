<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class FileHelper
{
    public static function writeArchive(
        mixed $content, 
        string $filename, 
        string $disk = 'public',
        string $option = 'public'
    )
    {
        return Storage::disk($disk)->put($filename, $content, $option);
    }

    public static function getArchiveUrl(string $filename, string $disk = 'public')
    {
        return Storage::disk($disk)->url($filename);
    }
}
