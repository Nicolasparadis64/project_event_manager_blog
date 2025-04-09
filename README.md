# Event Manager - Projet de Gestion d'Événements

Ce projet est une application web de gestion d'événements construite avec PHP, MySQL et Docker.

## Prérequis

- Docker
- Docker Compose

## Méthode 1 : Déploiement via GitHub (Développement)

1. Clonez ce dépôt :
   ```bash
   git clone https://github.com/Nicolasparadis64/project_event_manager_blog
   cd project_event_manager_blog
   ```

2. Copier le fichier .env.example en .env :
   ```bash
   cp .env.example .env
   ```

3. Modifier le fichier .env avec vos informations :
   ```bash
   nano .env  # ou votre éditeur préféré
   ```

4. Installer les dépendances :
   ```bash
   npm install
   ```

5. Lancer les conteneurs Docker :
   ```bash
   docker-compose up -d
   ```

## Méthode 2 : Déploiement via Docker Hub (Production/Examen)

1. Créer un dossier vide :
   ```bash
   mkdir event_manager
   cd event_manager
   ```

2. Copier le fichier .env.examiner.example en .env :
   ```bash
   cp .env.examiner.example .env
   ```

3. Modifier le fichier .env avec vos informations :
   ```bash
   nano .env  # ou votre éditeur préféré
   ```

4. Lancer les conteneurs Docker :
   ```bash
   docker-compose -f docker-compose.examiner.yml up -d
   ```

## Accès à l'application

- Frontend : http://localhost
- phpMyAdmin : http://localhost:8080

## Structure du projet

- `back/` : Contient le code backend PHP
- `public/` : Contient les fichiers publics (CSS, JS, images)
- `src/` : Contient le code source PHP
- `views/` : Contient les fichiers de vue

## Informations de connexion

### Base de données
- Host : db (à l'intérieur des conteneurs) ou localhost (depuis votre machine)
- Port : 3306
- Base de données : event_manager
- Utilisateur : (celui défini dans votre .env)
- Mot de passe : (celui défini dans votre .env)
- Mot de passe root : (celui défini dans votre .env)

### Comptes utilisateurs
- Admin :
  - Email : admin@admin.com
  - Mot de passe : admin
- Utilisateur test :
  - Email : bob
  - Mot de passe : test

## Fonctionnalités

- Gestion des événements (création, modification, suppression)
- Inscription des utilisateurs aux événements
- Interface administrateur
- Interface utilisateur
