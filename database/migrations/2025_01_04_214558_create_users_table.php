<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Finction pour Exécuter les migrations.
    public function up(): void
    {
        // Créez la table 'users'
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Clé primaire
            $table->string('name'); // Nom de l'utilisateur
            $table->string('email')->unique(); // Email de l'utilisateur, doit être unique
            $table->string('password'); // Mot de passe de l'utilisateur
            $table->integer('points')->default(0); // Points de l'utilisateur, par défaut 0
            $table->timestamps(); // Horodatages pour created_at et updated_at
        });
    }

    // Fonction pour Annuler les migrations.
    public function down(): void
    {
        // Supprimez la table 'users' si elle existe
        Schema::dropIfExists('users');
    }
};
