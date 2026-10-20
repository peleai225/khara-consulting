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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique(); // about, home, etc.
            $table->string('title');
            $table->text('hero_title')->nullable(); // Titre de la section hero
            $table->text('hero_subtitle')->nullable(); // Sous-titre hero
            $table->string('hero_image')->nullable(); // Image hero
            $table->text('content')->nullable(); // Contenu principal (HTML)
            $table->text('mission')->nullable(); // Mission
            $table->text('vision')->nullable(); // Vision
            $table->text('values')->nullable(); // Valeurs (JSON)
            $table->string('meta_title')->nullable(); // SEO
            $table->text('meta_description')->nullable(); // SEO
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
