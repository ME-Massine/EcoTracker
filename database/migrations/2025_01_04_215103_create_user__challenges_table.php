<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Methode exécutée lors de la migration
    public function up(): void
    {
        // Création de la table 'user__challenges'
        Schema::create('user__challenges', function (Blueprint $table) {
            $table->id(); // Colonne ID auto-incrémentée
            $table->unsignedBigInteger('user_id'); // Colonne pour l'ID de l'utilisateur
            // Définition de la clé étrangère pour 'user_id'
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('challenge_id')->unsigned(); // Colonne pour l'ID du challenge
            // Définition de la clé étrangère pour 'challenge_id'
            $table->foreign('challenge_id')->references('id')->on('challenges');
            $table->boolean('status')->default(false); // Colonne pour le statut du challenge
            $table->timestamps(); // Colonnes 'created_at' et 'updated_at'
        });
    }

    // Methode exécutée lors de la suppression de la migration
    public function down(): void
    {
        // Suppression de la table 'user__challenges'
        Schema::dropIfExists('user__challenges');
    }
};
