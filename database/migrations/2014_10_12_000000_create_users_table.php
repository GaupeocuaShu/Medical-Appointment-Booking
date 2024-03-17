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
            $table->string("username")->unique();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->text("address")->nullable(); 
            $table->string("phone")->nullable(); 
            $table->string("avatar")->nullable();
            $table->tinyInteger("gender")->nullable();
            $table->date("date_of_birth")->nullable();
            $table->text("description")->nullable();
            $table->enum("role",['user','doctor','admin'])->default('user');
            $table->boolean("status")->default(true);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
