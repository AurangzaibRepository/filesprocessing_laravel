<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('file_records', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->id();
            $table->bigInteger('unique_key')
                ->unique();
            $table->string('product_title', 300);
            $table->text('product_description');
            $table->string('style_no', 20);
            $table->string('sanmar_mainframe_color', 30);
            $table->string('size', 10);
            $table->string('color_name', 30);
            $table->double('piece_price', 6, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('file_records');
    }
};
