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
        Schema::create('slides', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(); // Titre principal
            $table->string('subtitle')->nullable(); // Sous-titre
            $table->text('description')->nullable(); // Description
            $table->string('button_text')->nullable(); // Texte du bouton
            $table->string('button_link')->nullable(); // Lien du bouton
            $table->string('button_text_2')->nullable(); // Texte du 2ème bouton
            $table->string('button_link_2')->nullable(); // Lien du 2ème bouton
            $table->string('badge_text')->nullable(); // Texte du badge
            $table->string('image')->nullable(); // Image de fond
            $table->string('background_position')->default('center'); // Position de l'image
            $table->integer('order')->default(0); // Ordre d'affichage
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slides');
    }
};
