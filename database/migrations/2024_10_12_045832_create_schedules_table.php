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
        Schema::disableForeignKeyConstraints();

        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->enum('day', ["monday","tuesday","wednesday","thursday","friday"]);
            $table->time('start_time');
            $table->time('end_time');
            $table->foreignId('lecturer_id')->constrained('Lecturers');
            $table->foreignId('group_id')->constrained('Groups');
            $table->foreignId('room_id')->constrained('Rooms');
            $table->foreignId('course_id')->constrained('Courses');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
