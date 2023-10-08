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

    public $timeout = 20000;

    public function __construct(
        private File $file,
        private string $fileName,
    ) {
    }

    public function handle(): void
    {   
        $this->file->updateStatus($this->file->id, 'processing');
        $data = FileHelper::parseFile($this->fileName);

        FileRecord::addRecords($data);

        $this->file->updateStatus($this->file->id, 'completed');
    }

    public function failed(Throwable $exception): void
    {
        $this->file->updateStatus($this->file->id, 'failed');
    }
}
