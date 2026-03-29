<?php
// Connexion MySQL
$host = 'db0000';  // nom du service Docker MySQL
$db   = 'news_db0000';
$user = 'root';
$pass = 'root';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "Connexion réussie !<br>";

    // Test insertion
    $stmt = $pdo->prepare("INSERT INTO articles (title, content) VALUES (?, ?)");
    $stmt->execute(['Test Article', 'Contenu de test']);
    echo "Insertion OK !<br>";

    // Test lecture
    $stmt = $pdo->query("SELECT * FROM articles");
    $articles = $stmt->fetchAll();
    echo "Lecture OK !<br>";
    foreach ($articles as $a) {
        echo "ID: {$a['id']} - Title: {$a['title']}<br>";
    }

} catch (PDOException $e) {
    echo "Erreur DB : " . $e->getMessage();
}