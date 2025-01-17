<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Exécute les migrations.
     */
    public function up(): void
    {
        // Crée la table 'challenges'
        Schema::create('challenges', function (Blueprint $table) {
            $table->id(); // Colonne ID auto-incrémentée
            $table->string('title'); // Colonne pour le titre du challenge
            $table->string('description'); // Colonne pour la description du challenge
            $table->integer('points'); // Colonne pour les points du challenge
            $table->timestamps(); // Colonnes pour les timestamps created_at et updated_at
        });
    }

    /**
     * Annule les migrations.
     */
    public function down(): void
    {
        // Supprime la table 'challenges' si elle existe
        Schema::dropIfExists('challenges');
    }
};
