#!/bin/bash

# Définir les permissions correctes pour le dossier uploads
chmod 777 /var/www/html/uploads 2>/dev/null || true

# Démarrer Apache
exec apache2-foreground
