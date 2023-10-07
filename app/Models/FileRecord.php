<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class FileRecord extends Model
{
    protected $fillable = [
        'unique_key',
        'product_title',
        'product_decription',
        'style_no',
        'sanmar_mainframe_color',
        'size',
        'color_name',
        'piece_price',
        'file_id',
    ];

    public function file(): Relation
    {
        return $this->belongsTo(File::class);
    }
}
