-- Créer la base
CREATE DATABASE IF NOT EXISTS news_db0000;
USE news_db0000;

-- Table admins
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Table articles
CREATE TABLE IF NOT EXISTS articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    keywords VARCHAR(500),
    featured_image VARCHAR(255),
    content LONGTEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Admin par défaut (mot de passe : admin123)
-- Exemple de mot de passe hashé 
INSERT INTO admins (nom , email, password)
VALUES ('admin','admin@mail.com', '$2y$10$tok9THoaapxOOmD79zEEpeCob9ZpDQc6Sq3sJR6NZXxaax6iEnNQq');

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Utilisateur par défaut
-- Mot de passe: user123 (hash bcrypt)
-- INSERT INTO users (nom, email, password) VALUES
-- ('user', 'user@mail.com', '$2y$12$8rUHkUetS4na10AQqzAaNOtpXnLXz7/z0XPzavPoIhI21K6P.nw9u')
-- ON DUPLICATE KEY UPDATE nom=nom;
