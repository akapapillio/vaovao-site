# 🔐 Flux d'Authentification Complète

## Vue d'ensemble global

Toutes les pages du site (FO et BO) nécessitent **authentification**.
- **Login obligatoire** avant d'accéder à localhost:8080
- Deux rôles: **Admin** (accès BO + FO) ou **User** (accès FO uniquement)
- Logout disponible dans dropdown menu

## 🔄 Flux complet utilisateur

### Cas 1: Admin se connecte
```
1. Visiteur arrive sur localhost:8080
2. ↓ check_user_auth.php redirige
3. Login page (/app/view/BO/login.php?type=admin)
4. Entre: admin / admin123
5. ✅ Connexion validée
6. $_SESSION['role'] = 'admin'
7. ↓ Redirection /app/view/BO/articles.php
8. Navbar affiche:
   - 👤 admin (dropdown)
   - Gestion Articles (lien)
   - Gestion Admins (lien)
   - 🚪 Déconnexion (button)
9. ✅ Peut créer/éditer/supprimer articles
10. ✅ Peut accéder BO complet
```

### Cas 2: User se connecte
```
1. Visiteur arrive sur localhost:8080
2. ↓ check_user_auth.php redirige
3. Login page (/app/view/BO/login.php?type=user)
4. Entre: user / user123
5. ✅ Connexion validée
6. $_SESSION['role'] = 'user'
7. ↓ Redirection / (Accueil FO)
8. Navbar affiche:
   - 👤 user (dropdown)
   - Accueil (lien)
   - 🚪 Déconnexion (button)
   - ❌ PAS de liens BO
9. ✅ Peut uniquement lire articles
10. ❌ Tentative /app/view/BO/articles.php
    → check_auth.php bloque (role != admin)
    → Redirection login
```

### Cas 3: User non connecté
```
1. Visiteur arrive sur localhost:8080
2. ↓ check_user_auth.php détecte:
   $_SESSION['role'] = undefined
3. ✅ Redirection /app/view/BO/login.php AUTOMATIQUE
4. Affiche formulaire connexion
5. Ne peut rien faire sans credentials
```

## 📁 Architecture protection

### Pages FO protégées
```
src/index.php
├─ include: src/app/view/FO/index.php
    ├─ require: check_user_auth.php
    │   └─ Vérifie: $_SESSION['role'] IN ['admin', 'user']
    │   └─ Si non → Redirection login.php
    ├─ require: ArticleController.php
    └─ Affiche articles (tous les utilisateurs connexes)

src/article.php
├─ include: src/app/view/FO/article.php
    ├─ require: check_user_auth.php
    │   └─ Même vérification
    ├─ require: ArticleController.php
    └─ Affiche détail article
```

### Pages BO protégées
```
/app/view/BO/articles.php
├─ require: check_auth.php
│   └─ Vérifie: $_SESSION['role'] === 'admin'
│   └─ Si non → Redirection login.php
└─ Affiche liste articles (admin uniquement)

/app/view/BO/create_article.php
├─ require: check_auth.php
│   └─ Protection admin
└─ Affiche formulaire + TinyMCE

/app/view/BO/edit_article.php
├─ require: check_auth.php
│   └─ Protection admin
└─ Affiche édition + TinyMCE

/app/view/BO/delete_article.php
├─ require: check_auth.php
│   └─ Protection admin
└─ Supprime article
```

## 🔑 Points clés

### check_user_auth.php (FO)
```php
if (!isset($_SESSION['role']) ||
    !in_array($_SESSION['role'], ['admin', 'user'])) {
    header('Location: /app/view/BO/login.php');
    exit;
}
// Variables disponibles:
// $current_role, $current_user_id, $current_user_nom
```

### check_auth.php (BO)
```php
if (!isset($_SESSION['role']) ||
    $_SESSION['role'] !== 'admin') {
    header('Location: /app/view/BO/login.php');
    exit;
}
// Variables disponibles:
// $admin_id, $admin_nom, $admin_email
```

## 🎯 Exemples concrets

### Exemple 1: User 👤
```
URL: http://localhost:8080/
↓ check_user_auth.php
→ session['role'] = undefined
↓ Redirection
→ http://localhost:8080/app/view/BO/login.php

Click: 👤 Utilisateur tab
Enter: user / user123
Click: Se connecter

→ session['role'] = 'user'
→ $_SESSION set avec user_id, user_nom, user_email
↓ Redirection
→ http://localhost:8080/ (Accueil autorisé)

Navbar affiche:
- Accueil
- 👤 user (dropdown)
  - Rôle: 👤 Utilisateur
  - Déconnexion

Try: http://localhost:8080/app/view/BO/articles.php
↓ check_auth.php
→ session['role'] = 'user' (pas 'admin')
↓ Redirection
→ Login page
```

### Exemple 2: Admin 🔐
```
URL: http://localhost:8080/
↓ check_user_auth.php
→ session['role'] = undefined
↓ Redirection
→ http://localhost:8080/app/view/BO/login.php

[Automatically on 🔐 Admin tab]
Enter: admin / admin123
Click: Se connecter

→ session['role'] = 'admin'
→ $_SESSION set avec admin_id, admin_nom, admin_email
↓ Redirection
→ http://localhost:8080/app/view/BO/articles.php

Navbar affiche:
- Accueil
- Gestion Articles (editable!)
- Gestion Admins (editable!)
- 👤 admin (dropdown)
  - Rôle: 🔐 Admin
  - Déconnexion

Click: Gestion Articles
→ /app/view/BO/articles.php ✅
→ Voir tous articles + boutons CRUD

Click: ✏️ Ajouter article
→ /app/view/BO/create_article.php ✅
→ TinyMCE editor apparaît
→ Peut créer article
```

## 🔄 Logout flow

### Admin se déconnecte
```
1. Navbar dropdown → Click 🚪 Déconnexion
2. ↓ Redirection /app/view/BO/logout.php
3. session_destroy()
4. $_SESSION cleared
5. ↓ Redirection /app/view/BO/login.php
6. Login form vide
7. Try /app/view/BO/articles.php
8. ↓ check_auth.php bloque
9. Redirection login
```

## 🛡️ Matrice d'accès

```
                    Anonymous  User   Admin
────────────────────────────────────────────
/                        ❌     ✅     ✅
/article.php?id=X        ❌     ✅     ✅
/app/view/BO/login.php   ✅     ✅     ✅
/app/view/BO/articles    ❌     ❌     ✅
/app/view/BO/create      ❌     ❌     ✅
/app/view/BO/edit        ❌     ❌     ✅
/app/view/BO/delete      ❌     ❌     ✅
/admin/admins.php        ❌     ❌     ✅
```

## 📝 Fichiers modifiés

Pour implémenter ce flux:

1. **src/app/view/FO/check_user_auth.php** (NEW)
   - Vérifie session et charge variables utilisateur

2. **src/app/view/FO/index.php** (UPDATED)
   - Ajoute: `require 'check_user_auth.php';`

3. **src/app/view/FO/article.php** (UPDATED)
   - Ajoute: `require 'check_user_auth.php';`

4. **src/app/view/FO/header.php** (UPDATED)
   - Dropdown menu avec rôle et déconnexion
   - Liens BO conditionnels (admin only)
   - Affichage nom utilisateur

5. **src/app/view/BO/check_auth.php** (UPDATED)
   - Maintenant vérifie: role === 'admin'

## 🎮 Cas d'usage pédagogique

### Pour tester le système complet:

**Test 1: Admin workflow**
```bash
1. Ouvrir localhost:8080
2. Redirection login → login.php
3. Sélectionner: 🔐 Admin
4. Enter: admin / admin123
5. Redirection: articles.php
6. ✅ Voir tous les articles
7. Click: ✏️ Ajouter article
8. ✅ TinyMCE chargé
9. Créer un article
10. Voir dans la liste
11. Navbar → Déconnexion
12. Redirection login
```

**Test 2: User workflow**
```bash
1. Ouvrir localhost:8080
2. Redirection login → login.php
3. Click: 👤 Utilisateur
4. Enter: user / user123
5. Redirection: /
6. ✅ Voir tous les articles
7. Click: Lire la suite
8. ✅ Voir détail article
9. Try: /app/view/BO/articles.php
10. ✅ Redirection login (accès refusé)
11. Navbar → Déconnexion
12. Redirection login
```

---

**Résumé**: Login OBLIGATOIRE pour accéder au site. Admin a accès total, User accès lecture uniquement.
