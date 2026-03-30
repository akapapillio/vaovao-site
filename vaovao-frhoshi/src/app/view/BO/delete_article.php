<?php
require_once dirname(__DIR__, 3) . '/config/bootstrap.php';
require_once 'check_auth.php';
require_once dirname(__DIR__, 3) . '/app/controllers/ArticleController.php';

$controller = new ArticleController();

// Récupérer l'ID de l'article
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if (!$id) {
    header('Location: articles.php?error=ID+article+manquant');
    exit;
}

try {
    // Vérifier que l'article existe
    $result = $controller->show($id);
    if (isset($result['error'])) {
        header('Location: articles.php?error=Article+non+trouvé');
        exit;
    }

    // Supprimer l'article
    $controller->delete($id);
    header('Location: articles.php?success=deleted');
    exit;
} catch (Exception $e) {
    header('Location: articles.php?error=' . urlencode($e->getMessage()));
    exit;
}
