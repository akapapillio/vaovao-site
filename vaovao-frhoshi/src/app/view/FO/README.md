# 🌍 Vaovao - FrontOffice

## Vue d'ensemble

La FrontOffice (FO) est une interface publique moderne et responsive pour consulter les articles d'actualités sur la situation en Iran et ses impacts géopolitiques.

## Structure

```
src/app/view/FO/
├── index.php          # Page d'accueil avec liste des articles (6 par page)
├── article.php        # Page de détail d'un article
├── header.php         # En-tête HTM avec navbar et styles Bootstrap
└── footer.php         # Pied de page commun
```

## Architecture MVC

La FO utilise une architecture MVC complète:

### Models
- **ArticleModel** (`src/app/models/ArticleModel.php`)
  - Validation de la logique métier
  - Méthodes: `getAllArticles()`, `getArticleById()`, etc.

### Controllers
- **ArticleController** (`src/app/controllers/ArticleController.php`)
  - Orchestration des opérations
  - Méthodes: `index()` (pagination), `show()` (détail)

### Repositories
- **ArticleRepository** (`src/app/repositories/ArticleRepository.php`)
  - Accès à la base de données
  - Hérite de `DatabaseRepository` pour les requêtes PDO

## Fonctionnalités

✅ **Affichage des articles**
- Grille responsive (3 colonnes sur desktop, 2 sur tablet, 1 sur mobile)
- Pagination (6 articles par page)
- Aperçu avec troncature du contenu

✅ **Page de détail**
- Affichage complet de l'article
- Métadonnées (date, ID)
- Lien de retour

✅ **Design optimisé**
- Bootstrap 5.3 CDN
- Couleurs cohérentes (rouge primaire #dc3545)
- Animations et transitions fluides
- Responsive design mobile-first
- Navbar navigationnable

✅ **Gestion d'erreurs**
- Page 404 pour articles inexistants
- Validation des paramètres
- Messages utilisateur clairs

## Utilisation

### Accès
```
FrontOffice:  http://localhost:8080/
Article:      http://localhost:8080/article.php?id=1
```

### Routes supportées
- `/` → Liste des articles (page 1)
- `/?page=2` → Liste des articles (page 2)
- `/article.php?id=1` → Détail de l'article n°1
- `/admin/admins.php` → Gestion des administrateurs

## Données

### Table articles
```sql
CREATE TABLE articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content LONGTEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Articles pré-chargés
6 articles d'exemple sur la situation en Iran sont insérés automatiquement:
1. La situation actuelle en Iran : Un regard géopolitique
2. Les acteurs principaux et leur influence
3. Analyse des tensions récentes et causes profondes
4. Impact économique des tensions au Moyen-Orient
5. Perspectives et évolutions possibles
6. Rôle de la communauté internationale

## Déploiement

### Démarrage avec Docker
```bash
cd vaovao-frhoshi
docker-compose up -d --build

# Accès
- FO: http://localhost:8080/
- phpMyAdmin: http://localhost:8081/
```

### Initialisation de la BD
La base de données est initialisée automatiquement avec:
1. `docker/mysql/init.sql` → Création des tables
2. `docker/mysql/insert-articles.sql` → Insertion des articles

## Sécurité

✅ **Mesures implémentées**
- Prepared statements (PDO) → Protection SQL injection
- htmlspecialchars() → Prévention XSS
- Validation côté serveur
- Type casting des paramètres

⚠️ **À améliorer**
- Authentification pour les opérations CRUD
- HTTPS en production
- Rate limiting
- CSRF tokens pour formulaires futurs

## À venir (BackOffice)

- [ ] Formulaire création article
- [ ] Édition articles
- [ ] Suppression articles
- [ ] Authentification admin
- [ ] Éditeur riche (TinyMCE)
- [ ] Gestion des URL rewriting

## Développement

### Ajouter un nouvel article (via phpMyAdmin)
```sql
INSERT INTO articles (title, content) VALUES
('Titre', 'Contenu ...'),
```

### Modifier la pagination
Éditer `ArticleController.php` ligne 11:
```php
private $articlesPerPage = 6; // Changer ce nombre
```

### Ajouter des styles personnalisés
Éditer le `<style>` dans `header.php`

## Test

### Vérification rapide
1. Aller à http://localhost:8080/
2. Vérifier l'affichage des 6 articles
3. Cliquer sur "Lire la suite"
4. Vérifier le détail de l'article
5. Tester la pagination

## Notes

- Le projet suit un pattern MVC distinct du framework
- Pas de dépendances externes (except Bootstrap CDN)
- Code PHP orienté objet
- Utilise PDO pour les requêtes DB
- Responsive et optimisé SEO (structure HTML5 sémantique)
