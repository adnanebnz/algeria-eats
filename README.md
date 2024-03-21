# Algeria Eats
Algeria Eats est une plateforme innovante qui réunit les artisans, les livreurs et les consommateurs autour de produits artisanaux de qualité. Grâce à la TALL Stack (Tailwind CSS, Alpine.js, Laravel, Livewire), Algeria Eats offre une expérience utilisateur fluide et dynamique.

## Fonctionnalités clés
- Commande de produits artisanaux : Les consommateurs peuvent parcourir une variété de produits alimentaires artisanaux et passer des commandes en ligne.

- Vente de produits : Les artisans peuvent créer des comptes et vendre leurs produits sur la plateforme, en atteignant ainsi une large audience.

- Livraison efficace : Les livreurs peuvent s'inscrire sur la plateforme pour livrer les commandes aux consommateurs, assurant ainsi une livraison rapide et efficace.

- Gestion des commandes : Algeria Eats propose une interface de gestion des commandes pour les artisans et les livreurs, facilitant ainsi le suivi et la gestion des livraisons.

## Comment lancer le projet
- Ouvrir 2 terminaux : un pour npm et l'autre pour php artisan et composer.

- Installer les dépendances npm : npm install.

- Installer les dépendances composer : composer install.

- Lancer les migrations de la base de données : php artisan migrate.

- Lancer le projet dans les 2 terminaux : npm run dev et php artisan serve.

- Remplir la base de données avec des données aléatoires : php artisan db:seed --class="NomDeClasse".

- Les Noms de Classes pour le seed : ArtisanSeeder, AdminSeeder, DeliveryManSeeder, ConsumerSeeder, ProductSeeder.
- Injecter les villes et communes algériennes dans la base de données : php artisan db:seed --class="AnouarTouati\AlgerianCitiesLaravel\Database\Seeders\AlgerianCitiesSeeder".
