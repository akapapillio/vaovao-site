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
