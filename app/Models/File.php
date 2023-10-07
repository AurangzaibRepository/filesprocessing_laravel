<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class File extends Model
{
    protected $fillable = [
        'name',
        'status',
    ];

    public function saveRecord(Request $request): void
    {
        $fileObject = $request->file('inputfile');

        $file = $this->create([
            'name' => $fileObject->getClientOriginalName(),
        ]);

        $this->saveFile($fileObject, $file->id);
    }

    private function saveFile($fileObject, int $id): void
    {
        $fileBaseName = Str::of($fileObject->getClientOriginalName())->explode('.')[0];

        $fileObject->move(
            public_path('files'),
            "{$fileBaseName}_{$id}.{$fileObject->getClientOriginalExtension()}"
        );
    }
}