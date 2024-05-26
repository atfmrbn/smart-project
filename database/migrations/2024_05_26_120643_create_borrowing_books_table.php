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
        Schema::create('borrowing_books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('librarian_id');
            $table->unsignedBigInteger('student_id');
            $table->string('description');
            $table->date('checkout_date');
            $table->date('due_date');
            $table->date('returned_date');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('librarian_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('student_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowing_books');
    }
};
