#!/bin/bash

# Couleurs pour les messages
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Fonction pour afficher les messages
print_message() {
    echo -e "${2}${1}${NC}"
}

# Fonction pour vérifier si Docker est en cours d'exécution
check_docker() {
    if ! docker info > /dev/null 2>&1; then
        print_message "Docker n'est pas en cours d'exécution. Veuillez démarrer Docker." "$RED"
        exit 1
    fi
}

# Commande : up - Démarre tous les conteneurs
up() {
    print_message "🚀 Démarrage des conteneurs..." "$GREEN"
    docker-compose up -d
    print_message "✅ Les conteneurs sont démarrés !" "$GREEN"
    print_message "📝 Accès aux services :" "$YELLOW"
    print_message "- Application Web: http://localhost" "$YELLOW"
    print_message "- phpMyAdmin: http://localhost:8080" "$YELLOW"
}

# Commande : down - Arrête tous les conteneurs
down() {
    print_message "🛑 Arrêt des conteneurs..." "$YELLOW"
    docker-compose down
    print_message "✅ Les conteneurs sont arrêtés !" "$GREEN"
}

# Commande : restart - Redémarre tous les conteneurs
restart() {
    print_message "🔄 Redémarrage des conteneurs..." "$YELLOW"
    docker-compose restart
    print_message "✅ Les conteneurs ont été redémarrés !" "$GREEN"
}

# Commande : logs - Affiche les logs des conteneurs
logs() {
    print_message "📋 Affichage des logs..." "$YELLOW"
    docker-compose logs -f
}

# Commande : build - Reconstruit les images
build() {
    print_message "🏗️ Construction des images..." "$YELLOW"
    docker-compose build
    print_message "✅ Les images ont été reconstruites !" "$GREEN"
}

# Commande : ps - Affiche l'état des conteneurs
ps() {
    print_message "📊 État des conteneurs :" "$YELLOW"
    docker-compose ps
}

# Commande : shell - Ouvre un shell dans le conteneur web
shell() {
    print_message "🐚 Ouverture d'un shell dans le conteneur web..." "$YELLOW"
    docker-compose exec web bash
}

# Commande : mysql - Ouvre un shell MySQL
mysql() {
    print_message "🗄️ Connexion à MySQL..." "$YELLOW"
    docker-compose exec db mysql -u nouvel_utilisateur -pmot_de_passe event_manager
}

# Vérification des arguments
check_docker

case "$1" in
    "up")
        up
        ;;
    "down")
        down
        ;;
    "restart")
        restart
        ;;
    "logs")
        logs
        ;;
    "build")
        build
        ;;
    "ps")
        ps
        ;;
    "shell")
        shell
        ;;
    "mysql")
        mysql
        ;;
    *)
        print_message "Usage: $0 {up|down|restart|logs|build|ps|shell|mysql}" "$YELLOW"
        print_message "\nCommandes disponibles :" "$YELLOW"
        print_message "  up      : Démarre tous les conteneurs" "$GREEN"
        print_message "  down    : Arrête tous les conteneurs" "$GREEN"
        print_message "  restart : Redémarre tous les conteneurs" "$GREEN"
        print_message "  logs    : Affiche les logs des conteneurs" "$GREEN"
        print_message "  build   : Reconstruit les images" "$GREEN"
        print_message "  ps      : Affiche l'état des conteneurs" "$GREEN"
        print_message "  shell   : Ouvre un shell dans le conteneur web" "$GREEN"
        print_message "  mysql   : Ouvre un shell MySQL" "$GREEN"
        exit 1
        ;;
esac 