# Event Manager - Projet de Gestion d'Événements

Ce projet est une application web de gestion d'événements construite avec PHP, MySQL et Docker.

## Prérequis

- Docker
- Docker Compose

## Lancement rapide pour l'examinateur

1. Clonez ce dépôt :
   ```bash
   git clone https://github.com/Nicolasparadis64/project_event_manager_blog
   cd project_event_manager_blog
   ```

2. Lancez l'application avec Docker Compose :
   ```bash
   docker-compose -f docker-compose.examiner.yml up -d
   ```

3. Accédez à l'application :
   - Application web : http://localhost
   - Interface phpMyAdmin : http://localhost:8080
     - Serveur : db
     - Utilisateur : nouvel_utilisateur
     - Mot de passe : mot_de_passe

4. Pour arrêter l'application :
   ```bash
   docker-compose -f docker-compose.examiner.yml down
   ```

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
- Utilisateur : nouvel_utilisateur
- Mot de passe : mot_de_passe
- Mot de passe root : root_password

### Comptes utilisateurs
- Admin :
  - Email : admin@admin.com
  - Mot de passe : admin
- Utilisateur test :
  - Email : userTest@gmail.com
  - Mot de passe : test

## Fonctionnalités

- Gestion des événements (création, modification, suppression)
- Inscription des utilisateurs aux événements
- Interface administrateur
- Interface utilisateur
