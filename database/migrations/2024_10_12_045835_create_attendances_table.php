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

        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->integer('sakit');
            $table->integer('izin');
            $table->integer('alpha');
            $table->time('entry_time')->nullable();
            $table->boolean('is_changed')->default(false);
            $table->boolean('lecturer_verified')->default(false);
            $table->foreignId('student_id')->constrained('Students');
            $table->foreignId('schedule_week_id')->constrained('schedule_weeks');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
