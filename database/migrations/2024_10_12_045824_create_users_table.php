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
            $table->string('username', 50)->unique();
            $table->string('password', 20);
            $table->string('email', 100)->unique();
            $table->unsignedBigInteger('userable_id');
            $table->enum('userable_type', ["student","lecturer","admin"]);
            $table->morphs('admin');
            $table->morphs('student');
            $table->morphs('lecturer');
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
