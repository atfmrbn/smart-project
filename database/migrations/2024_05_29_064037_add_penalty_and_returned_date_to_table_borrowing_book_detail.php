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
        Schema::table('borrowing_book_details', function (Blueprint $table) {
            $table->dateTime('returned_date')->nullable()->after('book_id');
            $table->string('penalty')->nullable()->after('returned_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('borrowing_book_details', function (Blueprint $table) {
            Schema::dropIfExists('borrowing_book_details');
        });
    }
};
