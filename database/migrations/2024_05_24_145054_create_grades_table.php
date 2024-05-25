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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_type_id');
            $table->unsignedBigInteger('student_teacher_classroom_relationship_id');
            $table->decimal('value', 5, 2); 
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('task_type_id')
                  ->references('id')
                  ->on('task_types')
                  ->onDelete('cascade');

            $table->foreign('student_teacher_classroom_relationship_id')
                  ->references('id')
                  ->on('student_teacher_classroom_relationships')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
