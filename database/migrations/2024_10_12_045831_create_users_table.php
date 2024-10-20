<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 100)->unique('users_username_unique');
            $table->string('password', 255)->default(Hash::make('password'));
            $table->string('nim', 10);
            $table->string('name', 100);
            $table->date('birth_date');
            $table->enum('gender', ["male", "female"]);
            $table->string('avatar', 200)->nullable();
            $table->boolean('verified')->default(false);
            $table->foreignId('group_id')->constrained('Groups');
            $table->string("token", 100)->nullable()->unique("users_token_unique");
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
