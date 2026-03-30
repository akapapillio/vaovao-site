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
    content LONGTEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Admin par défaut (mot de passe : admin123)
-- Exemple de mot de passe hashé avec bcrypt
INSERT INTO admins (nom , email, password)
VALUES ('admin','admin@mail.com', '$2y$10$wH8J9XyZQ8V5KXJ1Fh7YyO1k7WZQzQx0w1w1w1w1w1w1w1w1w1w1w');