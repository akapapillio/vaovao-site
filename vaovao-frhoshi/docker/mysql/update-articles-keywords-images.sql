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
