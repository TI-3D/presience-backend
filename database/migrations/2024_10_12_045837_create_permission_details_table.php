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

        Schema::create('permission_details', function (Blueprint $table) {
            $table->id();
            $table->enum('type_permission', ["sakit","izin"]);
            $table->enum('status', ["confirm","proses"])->default('proses');
            $table->foreignId('permission_id')->constrained('Permissions');
            $table->foreignId('schedule_week_id')->constrained('ScheduleWeeks');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_details');
    }
};
