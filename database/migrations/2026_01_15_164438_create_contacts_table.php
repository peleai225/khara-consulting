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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('whatsapp')->nullable();
            $table->enum('type', ['entrepreneur', 'entreprise', 'professionnel', 'etudiant', 'autre']);
            $table->json('needs'); // Array des besoins sélectionnés
            $table->string('budget')->nullable();
            $table->text('message');
            $table->boolean('contact_consent')->default(true);
            $table->boolean('privacy_consent')->default(true);
            $table->boolean('email_sent')->default(false); // Pour tracker si l'email a été envoyé
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
