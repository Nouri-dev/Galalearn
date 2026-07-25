# GalaLearn

GalaLearn est une plateforme e-learning développée avec Laravel 11 permettant aux étudiants de suivre des formations en ligne et aux enseignants de créer et gérer du contenu pédagogique.

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

## Prérequis

### Avant d'installer le projet, assurez-vous d'avoir :

- PHP >= 8.2
- Composer 2.x (version récente recommandée)
- MySQL 8.x recommandé
- Node.js >= 18 (Node.js 20 LTS recommandé)
- npm (fourni avec Node.js, version récente recommandée)

## Versions utilisées pour le développement

- PHP 8.3.8
- Composer 2.4.4
- MySQL 8.0.35
- Node.js 24.13.0
- npm 11.6.2


## Installation

### 1. Cloner le projet

git clone https://github.com/Nouri-dev/Galalearn.git

### 2. Installer les dépendances

composer install

### 3. Configuration de l'environnement

Copier le fichier .env.example :

cp .env.example .env

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

Générer la clé Laravel :
php artisan key:generate

### 4. Base de données

Créer votre base de données puis lancer :
php artisan migrate:fresh --seed

### 5. Frontend

Installer les dépendances frontend :
npm install

Compiler les assets :
npm run build

### 6. Lancer l'application

php artisan serve

Application disponible sur :

http://127.0.0.1:8000


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