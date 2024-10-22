<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // User yang meminjam buku
            $table->unsignedBigInteger('book_id'); // Buku yang dipinjam
            $table->timestamp('borrowed_at'); // Tanggal peminjaman
            $table->timestamp('returned_at')->nullable(); // Tanggal pengembalian
            $table->enum('status', ['borrowed', 'returned', 'late']); // Status peminjaman
            $table->decimal('fine')->default(0); // Denda jika terlambat
            $table->integer('denda')->default(0);
            $table->string('order_id')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('borrowings');
    }
}
