# Image officielle PHP avec Apache
FROM php:8.2-apache

# Installer extensions PHP nécessaires pour MySQL
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Activer mod_rewrite pour SEO / .htaccess
RUN a2enmod rewrite

# Autoriser l'utilisation de .htaccess
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Copier le code source dans Apache
COPY src/ /var/www/html/

# Créer le dossier uploads
RUN mkdir -p /var/www/html/uploads

# Copier le script d'entrée personnalisé
COPY docker/apache/docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Définir le répertoire de travail
WORKDIR /var/www/html

# Utiliser le script d'entrée personnalisé
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]