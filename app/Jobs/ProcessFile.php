<?php

namespace App\Jobs;

use App\Models\File;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\FileRecord;
use FormatHelper;
use FileHelper;

class ProcessFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private File $file,
        private string $fileName,
    ) {
    }

    public function handle(): void
    {   
        $this->file->updateStatus($this->file->id, 'processing');
        $data = FileHelper::parseFile($this->fileName);

        $this->addRecords($data);

        $this->file->updateStatus($this->file->id, 'completed');
    }

    private function addRecords(array $data)
    {
        foreach ($data as $row) {
            $productTitle = FormatHelper::cleanString($row['PRODUCT_TITLE'], 'UTF-8');
            $productDescription = FormatHelper::cleanString($row['PRODUCT_DESCRIPTION'], 'UTF-8');

            $attributeList = [
                'unique_key' => $row['UNIQUE_KEY'],
                'product_title' => $productTitle,
                'product_description' => $productDescription,
                'style_no' => $row['STYLE#'],
                'sanmar_mainframe_color' => $row['SANMAR_MAINFRAME_COLOR'],
                'size' => $row['SIZE'],
                'color_name' => $row['COLOR_NAME'],
                'piece_price' => $row['PIECE_PRICE'],
            ];

            FileRecord::upsert([
                $attributeList,
                $attributeList,
            ],
            [
                'product_title',
                'product_description',
                'style_no',
                'sanmar_mainframe_color',
                'size',
                'color_name',
                'piece_price',
            ]);
        }
    }
}
