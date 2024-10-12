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

        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 10);
            $table->string('name', 100);
            $table->date('birth_date');
            $table->enum('gender', ["male","female"]);
            $table->string('avatar', 200)->default(null);
            $table->string('photo', 200)->default(null);
            $table->boolean('verified')->default(false);
            $table->foreignId('department_id')->constrained('Departmens');
            $table->foreignId('group_id')->constrained('Groups');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
