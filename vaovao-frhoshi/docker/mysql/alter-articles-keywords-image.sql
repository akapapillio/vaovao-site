-- Modification table articles pour ajouter keywords et image
-- Date: 30 Mars 2026

USE news_db0000;

-- Ajouter les colonnes keywords et featured_image
ALTER TABLE articles
ADD COLUMN keywords VARCHAR(500) AFTER title,
ADD COLUMN featured_image VARCHAR(255) AFTER keywords;

-- Exemple de mise à jour des articles existants avec des mots-clés
UPDATE articles SET keywords = 'Iran, géopolitique, Moyen-Orient, tensions' WHERE id = 1;
UPDATE articles SET keywords = 'acteurs, régionaux, puissances, influence' WHERE id = 2;
UPDATE articles SET keywords = 'tensions, conflits, causes, enjeux' WHERE id = 3;
UPDATE articles SET keywords = 'économie, énergie, commerce, prix du pétrole' WHERE id = 4;
UPDATE articles SET keywords = 'avenir, scénarios, diplomatie, résolution' WHERE id = 5;
UPDATE articles SET keywords = 'international, communauté, ONU, multilatéralisme' WHERE id = 6;






-- Mettre à jour les articles avec keywords et featured_image
-- USE news_db0000;

-- Article 1
UPDATE articles
SET keywords = 'Iran-géopolitique-Moyen-Orient-tensions-relations-internationales',
    featured_image = '/images/articles/iran-geopolitique.jpg'
WHERE id = 1;

-- Article 2
UPDATE articles
SET keywords = 'acteurs-régionaux-puissances-influence-États-Unis-Israël-Arabie-Saoudite',
    featured_image = '/images/articles/acteurs-principaux.jpg'
WHERE id = 2;

-- Article 3
UPDATE articles
SET keywords = 'tensions-conflits-causes-profondes-enjeux-nucléaires-sécurité',
    featured_image = '/images/articles/tensions-recentes.jpg'
WHERE id = 3;

-- Article 4
UPDATE articles
SET keywords = 'économie-énergie-commerce-prix-du-pétrole-Détroit-d\'Ormuz-impact-global',
    featured_image = '/images/articles/impact-economique.jpg'
WHERE id = 4;

-- Article 5
UPDATE articles
SET keywords = 'avenir-perspectives-scénarios-diplomatie-négociations-résolution',
    featured_image = '/images/articles/perspectives-futures.jpg'
WHERE id = 5;

-- Article 6
UPDATE articles
SET keywords = 'communauté-internationale-ONU-multilatéralisme-coopération-paix',
    featured_image = '/images/articles/communaute-internationale.jpg'
WHERE id = 6;
