<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use FormatHelper;

class FileRecord extends Model
{
    protected $fillable = [
        'unique_key',
        'product_title',
        'product_description',
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

    /*public static function addRecords(array $data): void
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
    }*/

    public static function addRecords(array $row): void
    { 
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
