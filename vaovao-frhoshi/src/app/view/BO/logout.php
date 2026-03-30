<?php
require_once dirname(__DIR__, 3) . '/config/bootstrap.php';

// Détruire la session
session_destroy();

// Rediriger vers la page de login
header('Location: login.php');
exit;
