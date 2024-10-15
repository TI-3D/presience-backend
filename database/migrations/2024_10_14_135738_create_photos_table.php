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
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->string('photo1', 200)->default(null);
            $table->string('photo2', 200)->default(null);
            $table->string('photo3', 200)->default(null);
            $table->string('photo4', 200)->default(null);
            $table->string('photo5', 200)->default(null);
            $table->foreignId('student_id')->constrained('Students');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
