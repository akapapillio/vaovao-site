# 🎯 Guide d'utilisation - CRUD Articles BackOffice

## 🚀 Accès rapide

### URL d'accès

```
BackOffice Articles: http://localhost:8080/app/view/BO/articles.php
Créer Article:      http://localhost:8080/app/view/BO/create_article.php
Éditer Article:     http://localhost:8080/app/view/BO/edit_article.php?id=1
Voir Article:       http://localhost:8080/app/view/BO/view_article.php?id=1
```

## 📊 Dashboard BO

Le BackOffice contient:

### 1️⃣ Gestion Admins (ancien)
- Route: `/admin/admins.php`
- CRUD basique pour les administrateurs
- Voir, Ajouter, Supprimer

### 2️⃣ Gestion Articles (NOUVEAU ✨)
- Route: `/app/view/BO/articles.php`
- CRUD complet avec TinyMCE
- Créer, Lire, Éditer, Supprimer des articles

## 📋 Fonctionnalités CRUD Détaillées

### ✏️ **CREATE** - Créer un article

**URL**: `/app/view/BO/create_article.php`

**Étapes**:
1. Remplir le **Titre** (min 3 caractères)
2. Remplir le **Contenu** avec TinyMCE
3. Cliquer **"✓ Créer l'article"**
4. Message de confirmation → Retour à la liste

**TinyMCE disponible**:
- Formatage: Gras, Italique, Underline
- Listes: Numérotées et pointillées
- Alignement: Gauche, centre, droit, justifié
- Insertion: Liens, Images, Tableaux
- Plein écran pour édition confortable

### 📖 **READ** - Consulter les articles

**URL**: `/app/view/BO/articles.php`

**Fonctionnalités**:
- Tableau avec tous les articles
- Colonnes: ID, Titre, Date création
- Boutons pour chaque article:
  - 👁️ Voir (affiche détail)
  - ✏️ Éditer (modification)
  - 🗑️ Supprimer (avec confirmation)
- Statistiques: Compte total d'articles

### ✏️ **UPDATE** - Éditer un article

**URL**: `/app/view/BO/edit_article.php?id=1`

**Étapes**:
1. Champs pré-remplis avec données actuelles
2. Modifier **Titre** et/ou **Contenu**
3. Cliquer **"✓ Mettre à jour"**
4. Message de confirmation → Retour à la liste

**Informations affichées**:
- ID de l'article
- Date de création
- Contenu préchargé dans TinyMCE

### 🗑️ **DELETE** - Supprimer un article

**Deux façons**:

**Option 1** - Depuis la liste:
1. Aller à `/app/view/BO/articles.php`
2. Cliquer sur 🗑️ au bout de la ligne
3. Confirmer le message JavaScript
4. Article supprimé définitivement

**Option 2** - Depuis la page détail:
1. Aller à `/app/view/BO/view_article.php?id=1`
2. Cliquer sur 🗑️ "Supprimer"
3. Confirmer le message JavaScript
4. Article supprimé définitivement

## 🎨 Éléments de l'Interface

### En-tête (header.php)
- Logo et titre "Vaovao Back-Office"
- Navigation sidebar
- Lien vers admin et articles

### Sidebar Navigation
```
👤 Gestion Admins    → /admin/admins.php
📰 Gestion Articles  → articles.php
🏠 Retour au site    → /
```

### Messages de Feedback
- ✓ **Succès** (vert): Article créé/modifié/supprimé
- ✗ **Erreur** (rouge): Validation, données manquantes
- ℹ️ **Info** (bleu): Données de l'article

### Responsive Design
- **Sidebar** s'affiche sur desktop
- **Table** scrollable sur mobile
- **Boutons** adaptés à tous écrans

## 📝 Validation des champs

| Champ | Validation | Erreur |
|-------|-----------|--------|
| Titre | Requis, min 3 chars | "Le titre est requis" |
| Contenu | Requis | "Le contenu est requis" |
| ID | Doit exister | "Article introuvable" |

## 🔐 Sécurité

✅ Champs protégés:
- SQL Injection: Prepared statements PDO
- XSS: htmlspecialchars() sur affichage
- Type casting: Validation des IDs

⚠️ À ajouter:
- Authentification requise
- CSRF tokens
- Rate limiting

## 📊 Architecture Backend

```
Vues BO (PHP)          Contrôleur              Modèle              Repo              BD
articles.php      → ArticleController → ArticleModel → ArticleRepository → MySQL
create_article.php      .index()              .getAll          .fetchAll()
edit_article.php        .create()             .addArticle()    .execute()
delete_article.php      .update()             .updateArticle()
view_article.php        .delete()             .deleteArticle()
                        .show()               .getById()       .fetch()
```

## 🗄️ Structure de la Table

```sql
CREATE TABLE articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content LONGTEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## 💡 Tips & Tricks

### Éditer rapidement
1. Aller à `articles.php`
2. Cliquer ✏️
3. Modifier et soumettre

### Aperçu avant création
1. Créer article
2. Aller à `view_article.php?id=X` pour aperçu
3. Remodifier si besoin

### Récupérer un contenu riche
TinyMCE peut stocker:
- HTML formaté: `<strong>`, `<em>`, `<h2>`, etc.
- Listes: `<ul>`, `<ol>`
- Tableaux: `<table>`, `<tr>`, `<td>`
- Images: `<img src="">`

## 🆘 Dépannage

**"Article introuvable"**
- Vérifier l'ID dans l'URL
- Article a peut-être été supprimé

**"Le titre est requis"**
- Titre peut't être vide
- Minimum 3 caractères

**TinyMCE ne charge pas**
- Vérifier chemin: `/app/view/BO/tinymce/js/tinymce/tinymce.min.js`
- Vérifier permissions sur le dossier

**Erreur de base de données**
- Vérifier connexion MySQL (`db.php`)
- Table `articles` existe-t-elle?

## 📞 Support

Pour questions ou bugs:
- Vérifier les logs PHP
- Vérifier les messages d'erreur BO
- Consulter le fichier CRUD_ARTICLES_README.md

---

**Dernier update**: 30 Mars 2026
**Status**: ✅ Complet et fonctionnel
