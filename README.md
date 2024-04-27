# Gestion des affectations de téléphones aux employés

## Introduction
Ce projet vise à créer un système de gestion des affectations de téléphones aux employés. Il utilise Laravel, un framework d'application web avec une syntaxe expressive et élégante.

## Fonctionnalités
Le système offre les fonctionnalités suivantes :
- Enregistrement des employés avec leurs informations personnelles.
- Attribution et suivi des téléphones assignés à chaque employé.
- Gestion des différents modèles de téléphones disponibles.
- Génération automatique de données de test grâce à l'utilisation des seeders.

## Installation
Pour cloner et installer ce projet localement, suivez les étapes ci-dessous :

1. Clonez le projet depuis GitHub :
git clone https://github.com/Zainebazizi/OCP-gestion-des-employes.git

2. Installez les dépendances via Composer :
   
 composer install

3. Copiez le fichier d'environnement :

   cp .env.example .env

4. Exécutez les migrations pour créer les tables de base de données :
   
   php artisan migrate

9. Exécutez le seeder pour générer des données pour authentification :
    
      php artisan db:seed --class=AdminUserseeder

## Contribution
Merci de considérer contribuer à ce projet ! Veuillez consulter le guide de contribution dans la documentation de Laravel pour plus d'informations.

## Code de conduite
Pour garantir que la communauté Laravel est accueillante pour tous, veuillez lire et respecter le Code de Conduite.

## Licence
Ce projet est sous licence open-source MIT. Veuillez consulter le fichier LICENSE pour plus de détails.
