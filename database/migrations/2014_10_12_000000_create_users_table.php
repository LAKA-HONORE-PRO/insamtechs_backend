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
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('niveau_etude')->nullable();
            $table->string('ville')->nullable();
            $table->string('specialite')->nullable();
            $table->integer('tel_1')->nullable();
            $table->integer('tel_2')->nullable();
            $table->integer('nationalite')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role');
            $table->integer('droits');
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
