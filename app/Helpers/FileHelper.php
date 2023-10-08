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
            ->chunk(100)
            ->each(function ($rows) use ($header) {
                $data = null;

                foreach ($rows as $row) {
                    $data = array_combine($header, $row);
                    FileRecord::addRecords($data);
                }
            });
    }
}
