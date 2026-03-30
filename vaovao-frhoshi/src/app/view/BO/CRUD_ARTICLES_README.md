# 📰 CRUD Articles - Back-Office

## Vue d'ensemble

Un système complet CRUD pour la gestion des articles avec éditeur de contenu riche TinyMCE intégré.

## Fichiers du CRUD Articles

```
src/app/view/BO/
├── header.php              # En-tête et layout BO
├── footer.php              # Pied de page BO
├── articles.php            # 📖 Liste des articles (READ)
├── view_article.php        # 👁️ Voir un article (READ)
├── create_article.php      # ✏️ Créer un article (CREATE)
├── edit_article.php        # ✏️ Éditer un article (UPDATE)
└── delete_article.php      # 🗑️ Supprimer un article (DELETE)
```

## Fonctionnalités

### 📖 Liste des Articles (articles.php)
- Affiche tous les articles dans un tableau responsive
- Boutons d'action: Voir, Éditer, Supprimer
- Messages de feedback (succès/erreur)
- Statistiques (nombre total d'articles)
- Bouton "Ajouter un article"

### ✏️ Créer un Article (create_article.php)
- Formulaire avec champs:
  - **Titre** (textarea simple, min 3 caractères)
  - **Contenu** (utilise TinyMCE pour édition riche)
- **TinyMCE intégré** avec:
  - Plugins: bold, italic, lists, links, images, tables, etc.
  - Langage: Français
  - Hauteur: 500px
  - Toolbar complet pour formatage
- Validation côté serveur
- Redirection avec message de succès

### ✏️ Éditer un Article (edit_article.php)
- Chargement de l'article existant
- Préfill des données (titre, contenu)
- **TinyMCE intégré** (même config que création)
- Affiche la date de création
- Validation côté serveur
- Redirection avec message de succès

### 👁️ Voir un Article (view_article.php)
- Affichage en lecture seule
- Bouton "Éditer" pour modifier
- Bouton "Supprimer" avec confirmation
- Bouton "Retour à la liste"

### 🗑️ Supprimer un Article (delete_article.php)
- Supprime l'article de la BD
- Confirmation JavaScript avant suppression
- Redirection avec message de succès/erreur

## Intégration TinyMCE

TinyMCE est chargé localement depuis `/app/view/BO/tinymce/`

### Configuration TinyMCE utilisée

```javascript
tinymce.init({
    selector: '#content',
    language: 'fr_FR',
    height: 500,
    plugins: [
        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap',
        'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
        'insertdatetime', 'media', 'table', 'preview', 'help', 'wordcount'
    ],
    toolbar: 'undo redo | formatselect | bold italic backcolor | ' +
             'alignleft aligncenter alignright alignjustify | ' +
             'bullist numlist outdent indent | link image media | fullscreen | help'
});
```

### Plugins disponibles
- **advlist**: Listes numérotées avancées
- **link**: Insertion de liens
- **image**: Insertion d'images
- **table**: Tableaux
- **media**: Contenu multimédia
- **fullscreen**: Mode plein écran
- **code**: View HTML source
- **searchreplace**: Chercher/Remplacer
- **wordcount**: Comptage de mots

## Architecture MVC Utilisée

```
Request → Controller → Model → Repository → Database
  ↓         ↓           ↓         ↓            ↓
articles.php
           ArticleController.index()
                        ArticleModel.getAllArticles()
                                  ArticleRepository.getAllArticles()
                                                PDO Query
```

Les vues BO (`.php`) utilisent `ArticleController` pour récupérer et modifier les données.

## Flux d'utilisation

### Créer un article
1. Aller à `/admin/BO/create_article.php`
2. Remplir le titre
3. Remplir le contenu via TinyMCE
4. Cliquer "Créer l'article"
5. Retour à la liste avec message de succès

### Éditer un article
1. Aller à `/admin/BO/articles.php`
2. Cliquer sur ✏️ pour éditer
3. Modifier titre/contenu
4. Cliquer "Mettre à jour"
5. Retour à la liste avec message de succès

### Supprimer un article
1. Aller à `/admin/BO/articles.php`
2. Cliquer sur 🗑️
3. Confirmer la suppression
4. Article supprimé, retour à la liste

## Sécurité

✅ **Mesures implémentées**
- Prepared statements (PDO) → SQL Injection Protection
- htmlspecialchars() → XSS Protection
- Type casting (int) pour les IDs
- Validation titre/contenu côté serveur
- Redirection après traitement POST (PRG pattern)

⚠️ **À améliorer**
- Authentification requise pour accès BO
- CSRF tokens sur formulaires
- Rate limiting
- Audit logging

## Design et UX

- **Bootstrap 5.3** pour le responsive design
- **Sidebar navigation** pour accès aux sections
- **Breadcrumbs** pour contextualisation
- **Responsive tables** sur mobile
- **Messages de feedback** pour chaque action
- **Confirmations** avant actions destructives

## Routes d'accès

- Accueil articles: `/admin/BO/articles.php`
- Créer article: `/admin/BO/create_article.php`
- Éditer article: `/admin/BO/edit_article.php?id=1`
- Voir article: `/admin/BO/view_article.php?id=1`
- Supprimer article: `/admin/BO/delete_article.php?id=1` (GET request)

## Validation

### Titre
- Requis
- Minimum 3 caractères
- Validé côté serveur

### Contenu
- Requis
- Peut contenir HTML (TinyMCE)
- Validé côté serveur

## Messages système

### Succès
- `success=created` → "Article créé avec succès"
- `success=updated` → "Article mis à jour avec succès"
- `success=deleted` → "Article supprimé avec succès"

### Erreurs
- `error=...` → Message d'erreur personnalisé

## Notes techniques

- TinyMCE sauvegarde le contenu en HTML
- Le contenu est échappé avec `htmlspecialchars()` à l'affichage
- Les dates sont en `TIMESTAMP` avec `CURRENT_TIMESTAMP` par défaut
- Pas de authentification actuellement (à implémenter)
