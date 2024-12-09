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

        Schema::create('permit_details', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ["confirm", "proses","decline"])->default('proses');
            $table->foreignId('permit_id')->constrained('permits');
            $table->foreignId('schedule_week_id')->constrained('schedule_Weeks');
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
        Schema::dropIfExists('permission_details');
    }
};
