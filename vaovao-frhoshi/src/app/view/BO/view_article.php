<?php
require_once dirname(__DIR__, 3) . '/config/bootstrap.php';
require_once 'check_auth.php';
require_once dirname(__DIR__, 3) . '/app/controllers/ArticleController.php';

$pageTitle = 'Voir un Article - Back-Office';
$controller = new ArticleController();

// Récupérer l'ID de l'article
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
if (!$id) {
    header('Location: articles.php?error=ID+article+manquant');
    exit;
}

$result = $controller->show($id);
if (isset($result['error'])) {
    header('Location: articles.php?error=Article+introuvable');
    exit;
}
$article = $result['article'];

include 'header.php';
?>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Accueil</a></li>
            <li class="breadcrumb-item"><a href="articles.php">Articles</a></li>
            <li class="breadcrumb-item active">Voir l'article #<?= $article['id'] ?></li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="page-title">👁️ Visualiser l'article</h1>
        <div class="d-flex gap-2">
            <a href="edit_article.php?id=<?= $article['id'] ?>" class="btn btn-warning btn-lg">
                ✏️ Éditer
            </a>
            <a href="articles.php" class="btn btn-secondary btn-lg">
                ← Retour
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <!-- Titre -->
            <h2 style="color: var(--primary-color); margin-bottom: 1rem;">
                <?= htmlspecialchars($article['title']) ?>
            </h2>

            <!-- Métadonnées -->
            <div class="alert alert-info mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <strong>🆔 ID:</strong> <?= $article['id'] ?>
                    </div>
                    <div class="col-md-6">
                        <strong>📅 Créé le:</strong> <?= date('d/m/Y à H:i', strtotime($article['created_at'])) ?>
                    </div>
                </div>
            </div>

            <!-- Contenu -->
            <div style="background-color: #f8f9fa; padding: 1.5rem; border-radius: 8px; line-height: 1.8;">
                <?= nl2br(htmlspecialchars($article['content'])) ?>
            </div>

            <!-- Boutons d'action -->
            <div class="mt-4 d-flex gap-2">
                <a href="edit_article.php?id=<?= $article['id'] ?>" class="btn btn-warning">
                    ✏️ Éditer cet article
                </a>
                <button class="btn btn-danger"
                        onclick="confirmDelete(<?= $article['id'] ?>, '<?= htmlspecialchars(substr($article['title'], 0, 30)) ?>')">
                    🗑️ Supprimer
                </button>
                <a href="articles.php" class="btn btn-secondary">
                    ← Retour à la liste
                </a>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id, title) {
            if (confirm(`Êtes-vous sûr de vouloir supprimer l'article "${title}"?\n\nCette action est irréversible.`)) {
                window.location.href = `delete_article.php?id=${id}`;
            }
        }
    </script>

<?php include 'footer.php'; ?>
