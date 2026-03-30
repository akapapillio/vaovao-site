<?php
/**
 * Fichier de vérification d'authentification ADMIN
 * À inclure en haut de toutes les pages BO admin
 * Vérifie que l'utilisateur est administrateur
 */

// Vérifier si l'utilisateur est connecté ET qu'il est ADMIN
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // Rediriger vers la page de login
    header('Location: /app/view/BO/login.php');
    exit;
}

// Variables de session disponibles
$admin_id = $_SESSION['admin_id'] ?? null;
$admin_nom = $_SESSION['admin_nom'] ?? null;
$admin_email = $_SESSION['admin_email'] ?? null;
