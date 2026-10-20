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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nom du client
            $table->string('position')->nullable(); // Poste/fonction
            $table->string('company')->nullable(); // Entreprise
            $table->string('photo')->nullable(); // Photo du client
            $table->text('testimonial'); // Témoignage
            $table->integer('rating')->default(5); // Note sur 5
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
        Schema::dropIfExists('testimonials');
    }
};
