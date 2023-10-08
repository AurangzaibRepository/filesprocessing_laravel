<?php

namespace App\Helpers;

class FormatHelper
{
    public static function cleanString(string $string): string
    {
        return mb_convert_encoding($string, 'UTF-8');
    }
}