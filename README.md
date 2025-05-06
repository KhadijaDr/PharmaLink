# PharmaLink - Système de Gestion de Pharmacie

PharmaLink est une application web complète pour la gestion d'une pharmacie qui permet aux pharmaciens de gérer leur inventaire de médicaments, traiter les commandes des clients et publier des articles informatifs. Les clients peuvent consulter les médicaments disponibles, passer des commandes et contacter la pharmacie.

## Fonctionnalités principales

- **Gestion des médicaments** : Ajouter, modifier, supprimer et suivre l'inventaire des médicaments
- **Système de commande** : Permettre aux clients de passer des commandes et aux pharmaciens de les traiter
- **Alertes d'expiration** : Notification des médicaments proches de leur date d'expiration
- **Gestion des articles** : Publication d'articles informatifs sur la santé et les médicaments
- **Panel administratif** : Interface complète pour les pharmaciens
- **Authentification et autorisation** : Système de connexion sécurisé avec différents niveaux d'accès

## Technologies utilisées

- Laravel 12.x
- PHP 8.2
- MySQL/MariaDB
- Bootstrap 5
- JavaScript/jQuery

## Prérequis

- PHP >= 8.2
- Composer
- Node.js et NPM
- Serveur MySQL/MariaDB
- Extension PHP : BCMath, Ctype, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML

## Installation

Suivez ces étapes pour installer et configurer le projet :

1. **Cloner le dépôt**

```bash
git clone https://github.com/votre-nom/PharmaLink.git
cd PharmaLink
```

2. **Installer les dépendances PHP**

```bash
composer install
```

3. **Installer les dépendances JavaScript**

```bash
npm install
npm run build
```

4. **Configurer l'environnement**

```bash
cp .env.example .env
php artisan key:generate
```

5. **Configurer la base de données**

Modifiez le fichier `.env` avec vos informations de connexion à la base de données :

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pharmacy
DB_USERNAME=root
DB_PASSWORD=votre_mot_de_passe
```

6. **Exécuter les migrations et les seeders**

```bash
php artisan migrate
php artisan db:seed
```

7. **Créer un lien symbolique pour le stockage**

```bash
php artisan storage:link
```

8. **Démarrer le serveur de développement**

```bash
php artisan serve
```

L'application sera accessible à l'adresse http://localhost:8000

## Comptes par défaut

Après avoir exécuté les seeders, vous pouvez vous connecter avec les comptes suivants :

- **Pharmacien**
  - Email: admin@pharmacie.com
  - Mot de passe: password

- **Client**
  - Email: client@example.com
  - Mot de passe: password

## Structure du projet

- `app/` - Contient les modèles, contrôleurs et services de l'application
- `database/` - Migrations et seeders de la base de données
- `resources/` - Vues Blade, assets CSS/JS et fichiers de traduction
- `routes/` - Définition des routes de l'application
- `public/` - Fichiers accessibles publiquement (images, CSS, JS compilés)
- `storage/` - Fichiers téléchargés (prescriptions, images des médicaments, etc.)

## Contribuer

1. Forker le projet
2. Créer une branche pour votre fonctionnalité (`git checkout -b feature/amazing-feature`)
3. Commiter vos changements (`git commit -m 'Add some amazing feature'`)
4. Pousser vers la branche (`git push origin feature/amazing-feature`)
5. Ouvrir une Pull Request

## Licence

Ce projet est sous licence MIT. Voir le fichier [LICENSE](LICENSE) pour plus de détails.
