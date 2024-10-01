<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke user
            $table->foreignId('book_id')->constrained()->onDelete('cascade'); // Relasi ke buku
            $table->date('borrowed_at');
            $table->date('returned_at')->nullable();
            $table->timestamps();
        });
    }

};
