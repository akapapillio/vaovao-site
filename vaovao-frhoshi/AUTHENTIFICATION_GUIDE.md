# 🔐 Authentification - Back-Office

## Vue d'ensemble

Un système d'authentification simple pour sécuriser l'accès au BackOffice. **Seuls les administrateurs authentifiés** peuvent accéder aux pages de gestion (CRUD articles et admins).

## 📋 Fluxs d'authentification

### ✅ Utilisateur NON connecté
1. Accède à : `http://localhost:8080/app/view/BO/articles.php`
2. Redirection vers : `login.php`
3. Affiche : Formulaire de connexion

### ✅ Utilisateur connecté
1. Accède à : `http://localhost:8080/app/view/BO/articles.php`
2. Vérification de session OK
3. Affiche : Page articles avec bouton déconnexion
4. Accès à tous les CRUD (créer, éditer, voir, supprimer)

## 🔑 Fichiers d'authentification

```
src/app/view/BO/
├── login.php              # 🔐 Page de connexion
├── logout.php             # 🚪 Fichier de déconnexion
├── check_auth.php         # 🛡️ Vérification de session (inclus dans toutes les pages BO)
└── header.php             # Affiche admin connecté + bouton logout
```

## 🔑 Données de test

### Admin par défaut (créé à l'init)
- **Nom**: `admin`
- **Email**: `admin@mail.com`
- **Mot de passe**: `admin123`

Ces informations s'affichent sur la page de login comme aide.

## 📖 Pages protégées

Les pages BO suivantes sont protégées (demandent authentification):

✅ **CRUD Articles**
- `articles.php` - Liste des articles
- `view_article.php?id=X` - Voir un article
- `create_article.php` - Créer un article
- `edit_article.php?id=X` - Éditer un article
- `delete_article.php?id=X` - Supprimer un article

✅ **CRUD Admins**
- `/admin/admins.php` - Gestion des admins (à protéger si besoin)

## 🔍 Mécanisme de protection

Chaque page BO inclut `check_auth.php` au début:

```php
<?php
require_once dirname(__DIR__, 3) . '/config/bootstrap.php';
require_once 'check_auth.php';  // ← Vérification session
require_once dirname(__DIR__, 3) . '/app/controllers/ArticleController.php';
```

### Code de check_auth.php

```php
<?php
if (!isset($_SESSION['admin_id']) || !isset($_SESSION['admin_nom'])) {
    header('Location: /app/view/BO/login.php');
    exit;
}

$admin_id = $_SESSION['admin_id'];
$admin_nom = $_SESSION['admin_nom'];
```

**Logique**:
- Vérifier que la session contient `admin_id` et `admin_nom`
- Si non → Redirection vers login.php
- Si oui → Autoriser l'accès + charger variables session

## 🔐 Page de connexion (login.php)

### Champs du formulaire
- **Nom d'administrateur**: Doit correspondre à un admin en BD
- **Mot de passe**: Vérifié contre le hash bcrypt

### Processus de vérification
```
1. Récupérer tous les admins
2. Chercher un admin qui correspond au nom saisi
3. Vérifier password_verify(mot_de_passe_saisi, hash_stocké)
4. Si OK:
   - Créer session: $_SESSION['admin_id']
   - Créer session: $_SESSION['admin_nom']
   - Créer session: $_SESSION['admin_email']
   - Redirection vers articles.php
5. Si erreur:
   - Afficher message d'erreur
   - Garder le formulaire visible
```

### Sécurité

✅ **Mesures**
- Mots de passe hashés avec `password_hash()` (bcrypt)
- Vérification sécurisée avec `password_verify()`
- Messages d'erreur génériques (pas de révélation du type d'erreur)
- Session PHP standard (_SESSION)

⚠️ **À améliorer**
- HTTPS en production
- Rate limiting sur les tentatives de login
- Logs d'authentification
- Vérification d'adresse IP
- Expiration de session

## 🚪 Déconnexion (logout.php)

**Fonctionnement simple**:
```php
<?php
session_destroy();  // Destroy toute la session
header('Location: login.php');  // Redirection login
exit;
```

**Après déconnexion**:
- Session supprimée
- ALL cookies de session cleared
- Redirection vers login.php
- Toute tentative d'accès aux pages BO redirige vers login

## 🎯 Affichage admin connecté

Dans `header.php` (navbar):

```html
<div class="navbar-text text-white ms-auto">
    <span>👤 <?= htmlspecialchars($admin_nom ?? 'Admin') ?></span>
    <a href="logout.php" class="btn btn-sm btn-outline-light ms-2">🚪 Déconnexion</a>
</div>
```

**Affiche**:
- Icône + Nom de l'admin connecté
- Bouton de déconnexion

## 📊 Variable de session

### $_SESSION array
```php
[
    'admin_id'    => 1,              // ID de l'admin
    'admin_nom'   => 'admin',        // Nom de l'admin
    'admin_email' => 'admin@...'     // Email de l'admin
]
```

Ces variables sont disponibles dans `check_auth.php` et peuvent être utilisées dans les pages.

## 🔄 Flux complet de connexion

```
1. Utilisateur visite /app/view/BO/articles.php
   ↓
2. check_auth.php vérifie session
   ↓
3. Session NOT found → Redirection login.php
   ↓
4. Utilisateur remplit formulaire (nom + password)
   ↓
5. POST vers login.php
   ↓
6. Vérification nom + password_verify()
   ↓
7. ✓ OK → $_SESSION créée
   ↓
8. Redirection articles.php
   ↓
9. check_auth.php OK - page affichée
   ↓
10. Header affiche: "👤 admin" + bouton déconnexion
    ↓
11. Tout fonctionne normalement
```

## 🔄 Flux complet de déconnexion

```
1. Utilisateur clique bouton "Déconnexion"
   ↓
2. Redirection logout.php
   ↓
3. session_destroy() - session supprimée
   ↓
4. Redirection login.php
   ↓
5. Utilisateur voit formulaire login vide
   ↓
6. Si try accès /articles.php → Redirection login
```

## 🛠️ Tests manuels

### Test 1: Accès sans connexion
1. Ouvrir `http://localhost:8080/app/view/BO/articles.php`
2. ✓ Redirection vers login.php
3. ✓ Formulaire de connexion affiché

### Test 2: Mauvais mot de passe
1. Entrer nom: `admin`
2. Entrer password: `wrongpassword`
3. ✓ Erreur "Mot de passe incorrect"
4. ✓ Formulaire reste affiché

### Test 3: Admin inexistant
1. Entrer nom: `nonexistent`
2. Entrer password: `anything`
3. ✓ Erreur "Administrateur non trouvé"
4. ✓ Formulaire reste affiché

### Test 4: Connexion réussie
1. Entrer nom: `admin`
2. Entrer password: `admin123`
3. ✓ Redirection vers articles.php
4. ✓ Affichage "👤 admin" et "🚪 Déconnexion"
5. ✓ Accès au CRUD articles

### Test 5: Accès pages BO après connexion
1. Cliquer sur "✏️ Ajouter un article"
2. ✓ Page create_article.php chargée
3. ✓ TinyMCE fonctionnel
4. ✓ Créer un article

### Test 6: Déconnexion
1. Cliquer "🚪 Déconnexion"
2. ✓ Redirection login.php
3. ✓ Session supprimée
4. ✓ Try accès articles.php → Redirection login

## 🔐 Sécurité - Bonnes pratiques

✅ **Implémenté**
- Hash bcrypt pour les mots de passe
- Vérification password_verify()
- Session PHP standard
- Redirection authentifiée

⚠️ **À ajouter**
```php
// Rate limiting (limiter tentatives login)
// CSRF tokens sur formulaire
// HTTPS obligatoire
// Logs d'authentification
// Expiration de session (timeout)
// Vérification IP
```

## 📝 Notes techniques

- **Sessions** persistent via cookies PHP
- **Password hashing** utilise `PASSWORD_DEFAULT` (bcrypt actuellement)
- **Redirection** utilises `header()` avec `exit` pour sécurité
- **Échappement** HTML avec `htmlspecialchars()` pour affichage

## 🆘 Dépannage

### "Session non créée après connexion"
- Vérifier que `session_start()` est appelé dans bootstrap.php
- Vérifier que PHP a la permission d'écrire dans le dossier session

### "Toujours redirigé vers login même connecté"
- Vérifier que $_SESSION contient vraiment 'admin_id' et 'admin_nom'
- Vérifier que password_verify() est correct

### "Bouton déconnexion ne fonctionne pas"
- Vérifier que logout.php existe et path est correct
- Vérifier que session_destroy() fonctionne

---

**Dernière update**: 30 Mars 2026
**Status**: ✅ Sécurisé
