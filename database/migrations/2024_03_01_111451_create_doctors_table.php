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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->integer("workplace_id");
            $table->string("academic_degree")->nullable(); 
            $table->integer("experience_year")->nullable(); 
            $table->string("title")->nullable();
            $table->text("note")->nullable(); 
            $table->text("introduction")->nullable();
            $table->text("training_process")->nullable();
            $table->text("experience_list")->nullable();
            $table->text("prize_and_research")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
