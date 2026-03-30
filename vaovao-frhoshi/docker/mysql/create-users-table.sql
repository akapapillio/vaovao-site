-- Créer la table users pour les utilisateurs normaux
USE news_db0000;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Utilisateur par défaut
-- Mot de passe: user123 (hash bcrypt)
INSERT INTO users (nom, email, password) VALUES
('user', 'user@mail.com', '$2y$12$8rUHkUetS4na10AQqzAaNOtpXnLXz7/z0XPzavPoIhI21K6P.nw9u')
ON DUPLICATE KEY UPDATE nom=nom;
