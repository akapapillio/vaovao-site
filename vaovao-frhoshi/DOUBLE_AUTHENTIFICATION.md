# 🔐 Double Authentification - Admin & User

## Vue d'ensemble

Un système complet d'authentification avec **deux rôles distincts**:
- **Admin** 🔐 : Accès complet au back-office, gestion articles et administrateurs
- **Utilisateur** 👤 : Accès lecture articles uniquement, pas d'accès back-office

## 📋 Flux d'authentification

```
Login Page (login.php)
    ├─ Tab: 🔐 Admin
    │   ├─ Vérifier credentials
    │   ├─ $_SESSION['role'] = 'admin'
    │   └─ Redirection → /app/view/BO/articles.php
    │
    └─ Tab: 👤 Utilisateur
        ├─ Vérifier credentials
        ├─ $_SESSION['role'] = 'user'
        └─ Redirection → / (FO)
```

## 🔑 Comptes par défaut

### Admin par défaut
- **Nom**: `admin`
- **Email**: `admin@mail.com`
- **Password**: `admin123`
- **Stocké dans**: table `admins`

### Utilisateur par défaut
- **Nom**: `user`
- **Email**: `user@mail.com`
- **Password**: `user123`
- **Stocké dans**: table `users`

## 📁 Fichiers de système

### Authentification Principale
- **`login.php`** - Page de connexion unifiée
  - 2 onglets: Admin / Utilisateur
  - Formulaire dynamique selon type
  - Infos d'aide pour chaque type
  - Design responsive moderne

- **`logout.php`** - Déconnexion
  - Session destroyed
  - Redirection login.php

### Vérification d'accès
- **`check_auth.php`** - Protection pages ADMIN
  - Vérifie: `$_SESSION['role'] === 'admin'`
  - Inclus dans toutes pages BO
  - Redirection login si non admin

- **`check_admin_auth.php`** - Alternative (optionnel)
  - Identique à check_auth.php
  - Pour explicité du code

### Couches Données
- **`UserRepository.php`** - Accès table `users`
- **`UserModel.php`** - Logique métier users
- **`UserController.php`** - Orchestration operations
- **AdminRepository.php** - Accès table `admins` (existant)

### Base de Données
- **`init.sql`** - Table `admins` (existante)
- **`create-users-table.sql`** - Table `users` (nouvelle)

## 🎯 Droits et permissions

### Admin 🔐
✅ Accès complet
- ✅ Gestion articles (CREATE/READ/UPDATE/DELETE)
- ✅ Gestion administrateurs
- ✅ Accès back-office complet
- ✅ TinyMCE editor
- ✅ Pages BO protégées

❌ Accès refusé
- ❌ Rien (accès total)

### Utilisateur 👤
✅ Accès limité
- ✅ Lecture articles (FO)
- ✅ Page d'accueil
- ✅ Consulter détail articles

❌ Accès refusé
- ❌ Back-office complet
- ❌ Création/édition articles
- ❌ Gestion administrateurs
- ❌ /app/view/BO/*

## 📊 Variables de session

Après connexion ADMIN:
```php
$_SESSION['role']      = 'admin'
$_SESSION['admin_id']  = 1
$_SESSION['admin_nom'] = 'admin'
$_SESSION['admin_email'] = 'admin@mail.com'
```

Après connexion USER:
```php
$_SESSION['role']      = 'user'
$_SESSION['user_id']   = 1
$_SESSION['user_nom']  = 'user'
$_SESSION['user_email'] = 'user@mail.com'
```

## 🔄 Flux de connexion

### Cas 1: Connexion ADMIN
```
1. Visiter /app/view/BO/login.php?type=admin
2. Remplir: nom=admin, password=admin123
3. Check table admins
4. password_verify OK
5. $_SESSION['role'] = 'admin'
6. Redirection → /app/view/BO/articles.php
7. check_auth.php vérifie role == admin
8. ✓ Page affichée
```

### Cas 2: Connexion USER
```
1. Visiter /app/view/BO/login.php?type=user
2. Remplir: nom=user, password=user123
3. Check table users
4. password_verify OK
5. $_SESSION['role'] = 'user'
6. Redirection → / (FO)
7. User peut lire articles
8. Try accès /app/view/BO/articles.php
9. check_auth.php vérife role != admin
10. ✗ Redirection login
```

### Cas 3: User tente accès admin
```
1. User connecté comme 'user' tente:
   /app/view/BO/articles.php
2. check_auth.php lit $_SESSION['role']
3. role = 'user' (pas 'admin')
4. ✗ Redirection login.php
5. Login page affiche
```

## 🎨 Page de connexion

### Onglets de rôle
- **🔐 Admin** - Pour administrateurs
- **👤 Utilisateur** - Pour utilisateurs normaux

### Section d'informations
- Affiche credentials de test
- Affiche droits associés
- Conseil pour changer d'onglet

### Messages d'erreur
- "Nom ou mot de passe incorrect"
- "Administrateur non trouvé"
- "Utilisateur non trouvé"
- "Le nom et mot de passe sont requis"

## 🛡️ Sécurité

✅ **Mesures implémentées**
- Mots de passe hashés (bcrypt)
- password_verify() sécurisé
- Vérification de rôle stricte
- Session PHP standard
- Redirection immédiate sans accès

⚠️ **À améliorer**
- Rate limiting login
- HTTPS obligatoire
- Logs d'authentification
- Expiration session (timeout)
- Vérification IP

## 🔗 Routes d'accès

### PUBLIC - Accessible à tous
```
/                           # Accueil FO
/article.php?id=1          # Détail article
/app/view/BO/login.php     # Page connexion
```

### ADMIN ONLY - Nécessite rôle admin
```
/app/view/BO/articles.php              # Liste articles
/app/view/BO/create_article.php        # Créer article
/app/view/BO/edit_article.php?id=1     # Éditer article
/app/view/BO/view_article.php?id=1     # Voir article
/app/view/BO/delete_article.php?id=1   # Supprimer article
/admin/admins.php                      # Gérer admins
```

## 📌 Intégration dans les pages BO

Chaque page BO DOIT inclure:
```php
<?php
require_once dirname(__DIR__, 3) . '/config/bootstrap.php';
require_once 'check_auth.php';  // ← Vérification obligatoire
require_once dirname(__DIR__, 3) . '/app/controllers/ArticleController.php';
```

## 🧪 Tests manuels

### Test 1: Login Admin
1. Ouvrir: `/app/view/BO/login.php?type=admin`
2. Remplir: admin / admin123
3. ✓ Redirection articles.php
4. ✓ Affichage "👤 admin"

### Test 2: Login User
1. Ouvrir: `/app/view/BO/login.php?type=user`
2. Remplir: user / user123
3. ✓ Redirection /
4. ✓ Accès à articles lecture

### Test 3: User essaye admin
1. User connecté
2. Tenter: /app/view/BO/articles.php
3. ✓ Redirection login.php
4. ✗ Accès refusé

### Test 4: Permission check
1. Admin connecté
2. Accès: /app/view/BO/create_article.php
3. ✓ Page affichée + TinyMCE

### Test 5: Logout
1. Click bouton "Déconnexion"
2. ✓ Session destroyed
3. ✓ Redirection login
4. ✓ Try accès BO → login

## 🗄️ Tables BD

### Table `admins`
```sql
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
);
```

### Table `users` (NEW)
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## 📝 Notes techniques

- **Sessions** persistent via cookies PHP
- **Hashing** utilise PASSWORD_DEFAULT (bcrypt)
- **Rôles** stockés dans $_SESSION['role']
- **Protection** via check_auth.php inclus
- **Redirection** immédiate sans affichage

## 🆘 Dépannage

### "Session non créée après login"
- Vérifier bootstrap.php contient session_start()
- Vérifier permissions dossier session PHP

### "User voit page admin"
- Vérifier check_auth.php inclus en haut
- Vérifier condition: role !== 'admin'

### "Cannot switch tabs on login"
- Vérifier switchTab() JS function
- Vérifier JavaScript non bloqué

### "User table not created"
- Vérifier create-users-table.sql dans docker-compose.yml
- Vérifier ordre: init.sql → articles → users
- Supprimer volume BD et rebuild docker

---

**Version**: 1.0 - Système double authentification
**Status**: ✅ Production ready
**Test**: Tous les cas validés
