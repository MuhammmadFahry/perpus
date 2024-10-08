<?php

// database/migrations/create_books_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    public function up()
    {
    Schema::create('books', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('author');
    $table->integer('publication_year');
    $table->string('category');
    $table->text('description')->nullable(); // Add description field
    $table->string('cover_image')->nullable(); // Add cover image field
    $table->timestamps();
});

    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
}
