# GalaLearn

![Laravel](https://img.shields.io/badge/Laravel-11-red)
![PHP](https://img.shields.io/badge/PHP-8.3-blue)
![MySQL](https://img.shields.io/badge/MySQL-8-orange)
![Docker](https://img.shields.io/badge/Docker-ready-2496ED?logo=docker&logoColor=white)

GalaLearn est une plateforme e-learning développée avec Laravel 11 permettant aux étudiants de suivre des formations en ligne et aux enseignants de créer et gérer du contenu pédagogique.

Le projet peut être exécuté de deux façons :

- Installation classique (PHP, Composer, MySQL et Node.js)
- Avec Docker (Nginx, PHP, MySQL et phpMyAdmin)

## Fonctionnalités principales

### Utilisateurs

- Inscription et authentification
- Gestion des rôles (étudiant, enseignant, administrateur)

### Formations

- Création et gestion des cours
- Organisation par catégories
- Consultation des contenus pédagogiques

### Évaluations

- Création de quiz
- Participation aux quiz
- Suivi des résultats

### Communauté

- Publication d'articles pédagogiques
- Système de commentaires

Le projet utilise l'architecture MVC de Laravel afin de séparer la logique métier, la gestion des données et les interfaces utilisateur.


## Compte de démonstration

Un compte de démonstration est disponible afin de tester les différentes fonctionnalités de l'application :

**Compte de démonstration (multi-rôles)**

- Email : admin@example.com
- Mot de passe : Password6787

Rôles disponibles :
- Administrateur
- Enseignant
- Étudiant

Ce compte est uniquement destiné à la démonstration du projet.

## Prérequis

### Avant d'installer le projet, assurez-vous d'avoir :

- PHP >= 8.2
- Composer 2.x (version récente recommandée)
- MySQL 8.x recommandé
- Node.js >= 18 (Node.js 24 LTS recommandé)
- npm (fourni avec Node.js, version récente recommandée)

## Versions utilisées pour le développement

- PHP 8.3.8
- Composer 2.4.4
- MySQL 8.0.35
- Node.js 24.13.0
- npm 11.6.2


## Installation (sans Docker)

### 1. Cloner le projet

```bash
git clone https://github.com/Nouri-dev/Galalearn.git
```

### 2. Installer les dépendances

```bash
composer install
```

### 3. Configuration de l'environnement

Copier le fichier .env.example :
```bash
cp .env.example .env
```

Puis renseigner vos informations dans le fichier .env :

- Les identifiants de votre base de données MySQL :

```env
DB_DATABASE=GalaLearn
DB_USERNAME=root
DB_PASSWORD=votre_mot_de_passe
```

- Si vous souhaitez tester l'envoi d'emails lors de l'inscription, créez un compte gratuit Mailtrap et renseignez vos identifiants SMTP :

```env
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=votre_identifiant
MAIL_PASSWORD=votre_mot_de_passe
```


### 4. Générer la clé Laravel

```bash
php artisan key:generate
```

### 5. Base de données

Créer votre base de données puis lancer :
```bash
php artisan migrate:fresh --seed
```

### 6. Frontend

Installer les dépendances frontend :
```bash
npm install
```

Compiler les assets :
```bash
npm run build
```

### 7. Lancer l'application
```bash
php artisan serve
```

Application disponible sur :
```text
http://127.0.0.1:8000
```



## Installation avec Docker

Cette méthode permet de lancer l'application dans un environnement Docker contenant :

- PHP 8.3
- Nginx
- MySQL 8
- phpMyAdmin


### Prérequis

Avant de commencer, assurez-vous d'avoir installé :

- Docker Desktop
- Docker Compose
- Node.js >= 18 (Node.js 24 LTS recommandé)
- npm (fourni avec Node.js, version récente recommandée)


### 1. Cloner le projet

```bash
git clone https://github.com/Nouri-dev/Galalearn.git
```

### 2. Configuration de l'environnement

Copier le fichier .env.example : 
```bash
cp .env.example .env
```

Avec Docker, la configuration MySQL doit être :

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=GalaLearn
DB_USERNAME=root
DB_PASSWORD=root
```

### 3. Construire et démarrer les conteneurs

Depuis la racine du projet :
```bash
docker compose up -d --build
```

### 4. Installer les dépendances Laravel

Installer les dépendances PHP avec Composer :
```bash
docker compose exec app composer install
```

### 5. Générer la clé Laravel

```bash
docker compose exec app php artisan key:generate
```

Si nécessaire, videz le cache de configuration Laravel :
```bash
docker compose exec app php artisan config:clear
```


### 6. Installer les dépendances frontend

Installer les dépendances frontend :
```bash
npm install
```

Compiler les assets :
```bash
npm run build
```

### 7. Initialiser la base de données
```bash
docker compose exec app php artisan migrate:fresh --seed
```

### 8. Accéder à l'application

L'application est disponible sur:
```text
http://localhost
```

phpMyAdmin est accessible sur:
```text
http://localhost:8080
```

### 9. Arrêter l'environnement Docker
```bash
docker compose down
```