-- Créer la table users pour les utilisateurs normaux
USE news_db0000;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- User par défaut (mot de passe : user123)
INSERT INTO users (nom, email, password)
VALUES ('user', 'user@mail.com', '$2y$10$wH8J9XyZQ8V5KXJ1Fh7YyO1k7WZQzQx0w1w1w1w1w1w1w1w1w1w')
ON DUPLICATE KEY UPDATE nom=nom;
