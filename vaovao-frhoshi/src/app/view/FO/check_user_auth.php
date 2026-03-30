<?php
/**
 * Fichier de vérification d'authentification pour les pages FO
 * À inclure en haut de toutes les pages FO (index, article, etc)
 * Vérifie que l'utilisateur est connecté (admin OU user)
 */

// Vérifier si l'utilisateur est connecté (peu importe le rôle)
if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['admin', 'user'])) {
    // Rediriger vers la page de login
    header('Location: /app/view/BO/login.php');
    exit;
}

// Variables de session disponibles selon le rôle
if ($_SESSION['role'] === 'admin') {
    $current_user_id = $_SESSION['admin_id'] ?? null;
    $current_user_nom = $_SESSION['admin_nom'] ?? null;
    $current_user_email = $_SESSION['admin_email'] ?? null;
} else {
    $current_user_id = $_SESSION['user_id'] ?? null;
    $current_user_nom = $_SESSION['user_nom'] ?? null;
    $current_user_email = $_SESSION['user_email'] ?? null;
}

$current_role = $_SESSION['role'];
