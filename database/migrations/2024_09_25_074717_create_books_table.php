<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    // 2024_10_08_XXXXXX_create_books_table.php
   public function up()
{
    Schema::create('books', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('author');
        $table->integer('publication_year');
        $table->string('category');
        $table->string('image')->nullable(); // Added for book cover image
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('books');
    }
}
