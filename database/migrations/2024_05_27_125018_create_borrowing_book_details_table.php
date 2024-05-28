<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('borrowing_book_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('borrowing_book_id');
            $table->unsignedBigInteger('book_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('borrowing_book_id')
                  ->references('id')
                  ->on('borrowing_books')
                  ->onDelete('cascade');

            $table->foreign('book_id')
                  ->references('id')
                  ->on('books')
                  ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowing_book_details');
    }
};
