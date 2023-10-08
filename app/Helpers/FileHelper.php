<?php

namespace App\Helpers;

class FileHelper
{
    public static function parseFile(string $fileName): array
    {
        $data = [];
        $filePath = public_path('\files\\').$fileName;
        $fileReader = fopen($filePath, 'r');

        $header = fgetcsv($fileReader);

        while ($row = fgetcsv($fileReader)) {
            $data[] = array_combine($header, $row);
        }

        fclose($fileReader);

        return $data;
    }
}