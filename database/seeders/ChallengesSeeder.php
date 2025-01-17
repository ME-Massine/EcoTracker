<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Challenges;

class ChallengesSeeder extends Seeder
{
    // La méthode run est utilisée pour insérer des données dans Wla table Challenges
    public function run(): void
    {
        // Création d'un défi pour éteindre les lumières inutilisées
        Challenges::create([
            'title' => 'Éteindre les lumières inutilisées',
            'description' => 'Économisez de l\'énergie en éteignant les lumières lorsqu\'elles ne sont pas nécessaires.',
            'points' => 10,
        ]);

        // Création d'un défi pour utiliser des sacs réutilisables
        Challenges::create([
            'title' => 'Utiliser des sacs réutilisables',
            'description' => 'Réduisez les déchets plastiques en utilisant des sacs réutilisables pour vos courses.',
            'points' => 15,
        ]);

        // Création d'un défi pour planter un arbre
        Challenges::create([
            'title' => 'Planter un arbre',
            'description' => 'Contribuez à la reforestation en plantant un arbre dans votre communauté.',
            'points' => 50,
        ]);

        // Création d'un défi pour réduire la consommation d'eau
        Challenges::create([
            'title' => 'Réduire la consommation d\'eau',
            'description' => 'Prenez des mesures simples comme fermer le robinet pendant que vous vous brossez les dents.',
            'points' => 20,
        ]);

        // Création d'un défi pour adopter le covoiturage
        Challenges::create([
            'title' => 'Adopter le covoiturage',
            'description' => 'Réduisez votre empreinte carbone en partageant vos trajets avec d\'autres.',
            'points' => 25,
        ]);

        // Création d'un défi pour recycler les déchets
        Challenges::create([
            'title' => 'Recycler les déchets',
            'description' => 'Triez vos déchets et recyclez les matériaux tels que le papier, le plastique et le verre.',
            'points' => 30,
        ]);

        // Création d'un défi pour éviter les emballages en plastique
        Challenges::create([
            'title' => 'Éviter les emballages en plastique',
            'description' => 'Achetez en vrac et utilisez des contenants réutilisables pour éviter les emballages en plastique.',
            'points' => 15,
        ]);

        // Création d'un défi pour passer aux ampoules LED
        Challenges::create([
            'title' => 'Passer aux ampoules LED',
            'description' => 'Remplacez vos anciennes ampoules par des LED pour économiser de l\'énergie.',
            'points' => 20,
        ]);

        // Création d'un défi pour composter les déchets organiques
        Challenges::create([
            'title' => 'Composter les déchets organiques',
            'description' => 'Transformez vos déchets alimentaires en compost pour enrichir le sol.',
            'points' => 40,
        ]);

        // Création d'un défi pour utiliser les transports en commun
        Challenges::create([
            'title' => 'Utiliser les transports en commun',
            'description' => 'Réduisez les émissions de gaz à effet de serre en utilisant les bus ou les trains.',
            'points' => 30,
        ]);
    }
}
