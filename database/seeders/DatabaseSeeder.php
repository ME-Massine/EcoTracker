<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // La méthode run est appelée lorsque la commande db:seed est exécutée
    public function run(): void
    {
        // Appelle le seeder ChallengesSeeder pour insérer des données dans la base de données
        $this->call([
            ChallengesSeeder::class,
        ]);
    }
}
