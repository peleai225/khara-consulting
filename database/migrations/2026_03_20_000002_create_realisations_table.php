<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('realisations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('sector')->nullable();      // Secteur / badge
            $table->string('client')->nullable();      // Nom du client (optionnel)
            $table->text('summary')->nullable();       // Résumé (carte)
            $table->text('challenge')->nullable();     // Le défi
            $table->text('solution')->nullable();      // La solution
            $table->text('result')->nullable();        // Les résultats
            $table->string('image')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('realisations');
    }
};
