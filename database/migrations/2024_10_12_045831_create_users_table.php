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
            $table->string('fcm_id')->nullable()->default(null);
            $table->string('nim', 10);
            $table->string('name', 100);
            $table->date('birth_date');
            $table->enum('gender', ["male", "female"]);
            $table->string('avatar', 255)->nullable();
            $table->string('image_public_id')->nullable();
            $table->binary('face_embedding')->nullable();
            $table->boolean('verified')->default(false);
            $table->integer('semester')->default(5);
            $table->foreignId('group_id')->constrained('groups');
            $table->string("token", 100)->nullable()->unique("users_token_unique");
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
        Schema::dropIfExists('students');
    }
};
