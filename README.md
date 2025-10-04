# e-school

Plateforme de formation en ligne pour apprendre les langages incontournables du développement web et logiciel : HTML, CSS, JavaScript, PHP, Python et Java.

## Présentation

**e-school** propose des formations 100% en ligne, accessibles à tous, pour acquérir des compétences recherchées dans le domaine de la tech. L'objectif est de rendre l'apprentissage accessible, interactif et adapté au monde moderne.

## Fonctionnalités principales

- Catalogue de formations (HTML, CSS, JavaScript, PHP, Python, Java)
- Inscription et gestion de profil utilisateur
- Interface d'administration
- Système de contact et support
- Validation des formulaires côté client (JavaScript)
- Paiement (intégration Stripe, Paypal à venir)
- Certification à la fin des parcours

## Technologies utilisées

- **Backend** : PHP 8.2+, Symfony 7.3, Doctrine ORM
- **Frontend** : Twig, HTML5, CSS3, JavaScript natif
- **Base de données** : MySQL 8
- **Outils** : Docker, Mailhog, PhpMyAdmin
- **Tests** : PHPUnit

## Installation

1. Clonez le dépôt :
   ```bash
   $ git clone https://github.com/makombelajob/file-rouge.git && cd file-rouge/app
   ```
2. Installez les dépendances PHP :
   ```bash
   $ composer install
   ```
3. Configurez votre base de données dans `.env.local` (voir `.env` pour le format)
4. Lancez les migrations :
   ```bash
   $ cd ..
   $ docker compose exec php /bin/bash
   $ symfony console doctrine:migrations:migrate
   ```
5. (Optionnel) Chargez les fixtures de test :
   ```bash
   $ symfony console doctrine:fixtures:load
   ```
6. Lancez l'application avec Docker (recommandé) :
   ```bash
   $ docker compose up --build -d
   ```
7. Accédez à l'application via `http://localhost:8080`

## Utilisation avec Docker

Le projet inclut un fichier `docker-compose.yaml` pour lancer l'environnement complet (PHP, MySQL, PhpMyAdmin, Mailhog) :

```bash
docker compose up --build -d
```

- Application : http://localhost:8080
- PhpMyAdmin : http://localhost:8081
- Mailhog : http://localhost:8025

## Structure du projet

- `src/` : Code source Symfony (contrôleurs, entités, services)
- `templates/` : Templates Twig (pages, emails)
- `public/` : Fichiers publics (index.php, JS, CSS, images)
- `assets/` : Ressources front-end
- `migrations/` : Migrations de base de données
- `tests/` : Tests automatisés

## Contribution

Les contributions sont les bienvenues ! Merci de créer une issue ou une pull request pour toute suggestion ou amélioration.

## Licence

Projet sous licence propriétaire. Contactez l'équipe pour toute question.
