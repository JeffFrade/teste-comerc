<?php

namespace App\Helpers;

class StringHelper
{
    public static function replaceRegex(string $text, string $regex, string $replace)
    {
        return preg_replace($regex, $replace, $text);
    }
}
