FROM php:8.0-apache

# Installer les dépendances du système
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    libpng-dev \
    libjpeg-dev

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql mysqli zip gd

# Activer le module rewrite d'Apache
RUN a2enmod rewrite

# Configurer Apache pour supprimer l'avertissement "Could not reliably determine the server's fully qualified domain name"
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copier le contenu du projet dans le conteneur
COPY . /var/www/html/

# Configuration des permissions
RUN chown -R www-data:www-data /var/www/html 