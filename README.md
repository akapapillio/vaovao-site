# Vaovao Site - Mini-projet Web Design

Ce projet s'inscrit dans le cadre du **Mini-projet Web Design (Mars 2026)**. L'objectif est de créer un site web d'informations sur la guerre en Iran, avec une séparation claire entre un FrontOffice (affichage) et un BackOffice (gestion).

## 👥 Binôme
- **Prénom** : Nalitiana - N° ETU002647
- **Prénom** : Kiady - N° ETU003244

## 🎯 Objectifs
- **FrontOffice** : Afficher de manière claire et structurée les contenus d'information.
- **BackOffice** : Permettre l'ajout, la modification et la suppression de contenu (utilisation de l'éditeur **TinyMCE**).
- **Base de données** : Modélisation et intégration des données du site.

## 🚀 Fonctionnalités Principales

### BackOffice
- Authentification avec mot de passe/utilisateur par défaut sur `/login`.
- Édition de texte enrichi intégrée grâce à [TinyMCE](https://www.tiny.cloud/docs/tinymce/latest/).
- Gestion centralisée de la base de données.

### FrontOffice
- Interface utilisateur responsive et moderne.
- Contenus optimisés pour le web.

## 📈 Optimisation et Référencement (SEO)
Une attention particulière est portée à l'optimisation SEO de la plateforme :
- [ ] **URL Rewriting** (normalisation des URLs).
- [ ] **Hiérarchie Sémantique** claire avec les balises `<h1>` à `<h6>`.
- [ ] **Balises Méta** de titre et de description bien définies pour chaque page.
- [ ] **Attributs `alt`** systématiques pour toutes les images.
- [ ] **Score Lighthouse** optimisé (ordinateur et mobile).

## 🛠 Technologies
- **Langage / Framework** : Laravel
- **Base de données** : Mysql
- **Frontend** : Bootstrap with Laravel

## 📦 Livraison et Déploiement
- Projet fonctionnel, packagé sous forme de **conteneurs Docker** (fichier ZIP ou via `docker-compose`).
- Code source hébergé sur un **dépôt public** (GitLab ou GitHub).
- Livrable documentaire incluant :
  - Captures d'écran du FrontOffice et BackOffice.
  - Schéma de la modélisation de la base de données.
  - Identifiants par défaut du BackOffice.
