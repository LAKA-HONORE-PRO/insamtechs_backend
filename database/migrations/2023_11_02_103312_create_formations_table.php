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
        Schema::create('formations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categorie_id')->constrained();
            $table->foreignId('type_formation_id')->constrained();
            $table->json('intitule');
            $table->json('description')->nullable();
            $table->json('langue_formation')->nullable();
            $table->json('prix')->nullable();
            $table->string('lien')->nullable();
            $table->string('correction_link')->nullable();
            $table->integer('nombre_de_points')->nullable();
            $table->string('duree')->nullable();
            $table->string('duree_composition')->nullable();
            $table->string('date')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->integer('telechargeable')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formations');
    }
};
