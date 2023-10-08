<?php

namespace App\Helpers;

use App\Models\FileRecord;
use Illuminate\Support\LazyCollection;

class FileHelper
{
    public static function parseFile(string $fileName): void
    {
        $filePath = public_path('\files\\').$fileName;
        $fileReader = fopen($filePath, 'r');
        $header = fgetcsv($fileReader);

        LazyCollection::make(function () use ($fileReader) {

            while ($row = fgetcsv($fileReader)) {
                yield $row;
            }

            fclose($fileReader);
        })
            ->chunk(500)
            ->each(function ($rows) use ($header) {
                $data = [];

                foreach ($rows as $row) {
                    $data = array_combine($header, $row);
                    FileRecord::addRecords($data);
                }
            });
    }
}
