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

        Schema::create('schedule_weeks', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->boolean('is_online')->default(false);
            $table->enum('status', ["opened", "closed"])->default('closed');
            $table->time('opened_at')->nullable();
            $table->time('closed_at')->nullable();
            $table->foreignId('week_id')->constrained('Weeks');
            $table->foreignId('schedule_id')->constrained('Schedules');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_weeks');
    }
};
