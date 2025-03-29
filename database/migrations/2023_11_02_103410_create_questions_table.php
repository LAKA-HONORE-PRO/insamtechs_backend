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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formation_id')->constrained();
            $table->json('intitule');
            $table->json('nombre_de_points');
            $table->json('question_une');
            $table->json('question_deux');
            $table->json('question_trois')->nullable();
            $table->json('question_quatre')->nullable();
            $table->json('bonne_reponse');
            $table->string('slug')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
