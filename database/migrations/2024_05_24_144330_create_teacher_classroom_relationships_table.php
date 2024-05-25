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
        Schema::create('teacher_classroom_relationships', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('curriculum_id');
            $table->unsignedBigInteger('classroom_id');
            $table->unsignedBigInteger('teacher_subject_relationship_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('curriculum_id')
                  ->references('id')
                  ->on('curriculums')
                  ->onDelete('cascade');
            $table->foreign('classroom_id')
                  ->references('id')
                  ->on('classrooms')
                  ->onDelete('cascade');
            $table->foreign('teacher_subject_relationship_id', 'tsr_id')
                  ->references('id')
                  ->on('teacher_subject_relationships')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_classroom_relationships');
    }
};
