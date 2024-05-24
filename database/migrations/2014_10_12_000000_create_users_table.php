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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->date('born_date');
            $table->string('phone');
            $table->string('nik')->unique();
            $table->text('address');
            $table->enum('role', ['Super Admin', 'Admin', 'Librarian', 'Teacher', 'Student', 'Parent']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
