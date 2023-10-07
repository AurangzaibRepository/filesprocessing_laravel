<?php

namespace App\Models;

use App\Jobs\ProcessFile;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class File extends Model
{
    protected $fillable = [
        'name',
        'status',
    ];

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d-m-Y g:i A'),
        );
    }

    public function fileRecords(): Relation
    {
        return $this->hasMany(FileRecords::class);
    }

    public function getList(): Collection
    {
        $data = $this->orderByDesc('id')->get();

        return $data;
    }

    public function saveRecord(Request $request): void
    {
        $fileObject = $request->file('inputfile');

        $file = $this->create([
            'name' => $fileObject->getClientOriginalName(),
        ]);

        $this->saveFile($fileObject, $file);
    }

    private function saveFile($fileObject, File $file): void
    {
        $fileBaseName = Str::of($fileObject->getClientOriginalName())->explode('.')[0];
        $fileName = "{$fileBaseName}_{$file->id}.{$fileObject->getClientOriginalExtension()}";

        $fileObject->move(
            public_path('files'),
            $fileName
        );

        ProcessFile::dispatch($file, $fileName);
    }
}
