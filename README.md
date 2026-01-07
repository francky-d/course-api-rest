# Clone de DEV.to - API REST

Une API REST complète pour un clone de DEV.to, construite avec Laravel 11.

## Fonctionnalités

- Gestion des utilisateurs (Admin & Auteur)
- CRUD complet pour les posts, catégories, commentaires
- Système de séries d'articles
- Likes et favoris
- Système de followers
- Authentification avec Laravel Sanctum
- Recherche globale sur les posts

## Prérequis

Avant de commencer, assurez-vous d'avoir installé :

- [Docker Desktop](https://www.docker.com/products/docker-desktop)
- Git

**Note:** Laravel Sail utilise Docker, vous n'avez donc pas besoin d'installer PHP, Composer, MySQL, ou d'autres dépendances localement.

## Installation

### 1. Cloner le repository

```bash
git clone https://github.com/francky-d/course-api-rest.git
cd course-api-rest
```

### 2. Copier le fichier d'environnement

```bash
cp .env.example .env
```

### 3. Installer les dépendances avec Docker

**Sur macOS/Linux :**

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

**Sur Windows (PowerShell) :**

```powershell
docker run --rm `
    -v "${PWD}:/var/www/html" `
    -w /var/www/html `
    laravelsail/php83-composer:latest `
    composer install --ignore-platform-reqs
```

### 4. Démarrer les conteneurs Docker

```bash
./vendor/bin/sail up -d
```

### 5. Générer la clé d'application

```bash
./vendor/bin/sail artisan key:generate
```

### 6. Exécuter les migrations

```bash
./vendor/bin/sail artisan migrate
```

### 7. (Optionnel) Remplir la base de données avec des données de test

```bash
./vendor/bin/sail artisan db:seed
```

## Utilisation

### Démarrer l'application

```bash
./vendor/bin/sail up -d
```

### URLs d'accès aux services

Une fois les conteneurs démarrés, les services sont accessibles aux URLs suivantes :

| Service | URL | Description |
|---------|-----|-------------|
| **Application Laravel** | <http://localhost> | API REST principale |
| **PHPMyAdmin** | <http://localhost:8000> | Interface de gestion MySQL |
| **Mailpit** | <http://localhost:8025> | Interface de test des emails |
| **MySQL** | localhost:3306 | Base de données (connexion via client MySQL) |

### Identifiants de base de données

**Configuration par défaut (depuis .env) :**

```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```

**Pour PHPMyAdmin :**

- **Serveur :** `mysql`
- **Utilisateur :** `sail`
- **Mot de passe :** `password`
- **Base de données :** `laravel`

### Arrêter l'application

```bash
./vendor/bin/sail down
```
