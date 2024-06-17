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
        Schema::create('tuitions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tuition_type_id');
            $table->unsignedBigInteger('student_teacher_homeroom_relationship_id');
            $table->float('value');
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('tuition_type_id')
                  ->references('id')
                  ->on('tuition_types')
                  ->onDelete('cascade');

            $table->foreign('student_teacher_homeroom_relationship_id')
                  ->references('id')
                  ->on('student_teacher_homeroom_relationships')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tuitions');
    }
};
