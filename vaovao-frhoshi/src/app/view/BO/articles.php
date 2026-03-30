<?php
require_once dirname(__DIR__, 3) . '/config/bootstrap.php';
require_once 'check_auth.php';
require_once dirname(__DIR__, 3) . '/app/controllers/ArticleController.php';

$pageTitle = 'Gestion des Articles - Back-Office';
$controller = new ArticleController();
$data = $controller->index();
$articles = $data['articles'];

include 'header.php';
?>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Accueil</a></li>
            <li class="breadcrumb-item active">Gestion Articles</li>
        </ol>
    </nav>

    <!-- En-tête avec titre et bouton d'ajout -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="page-title">📰 Gestion des Articles</h1>
        <a href="create_article.php" class="btn btn-primary btn-lg">
            ✏️ Ajouter un article
        </a>
    </div>

    <!-- Messages de feedback -->
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>✓ Succès!</strong>
            <?php
            switch ($_GET['success']) {
                case 'created':
                    echo 'Article créé avec succès.';
                    break;
                case 'updated':
                    echo 'Article mis à jour avec succès.';
                    break;
                case 'deleted':
                    echo 'Article supprimé avec succès.';
                    break;
            }
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>✗ Erreur!</strong>
            <?php echo htmlspecialchars($_GET['error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Tableau des articles -->
    <div class="card">
        <div class="card-body">
            <?php if (empty($articles)): ?>
                <div class="text-center py-5">
                    <p style="color: #999; font-size: 1.1rem;">Aucun article trouvé. </p>
                    <a href="create_article.php" class="btn btn-primary">Créer le premier article</a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 5%">ID</th>
                                <th style="width: 40%">Titre</th>
                                <th style="width: 20%">Date de création</th>
                                <th style="width: 35%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($articles as $article): ?>
                                <tr>
                                    <td><strong>#<?= $article['id'] ?></strong></td>
                                    <td>
                                        <strong><?= htmlspecialchars(substr($article['title'], 0, 50)) ?></strong>
                                        <?php if (strlen($article['title']) > 50): ?>
                                            ...
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            <?= date('d/m/Y H:i', strtotime($article['created_at'])) ?>
                                        </small>
                                    </td>
                                    <td class="table-actions">
                                        <div class="action-buttons d-flex">
                                            <a href="view_article.php?id=<?= $article['id'] ?>"
                                               class="btn btn-sm btn-info" title="Voir">
                                                👁️
                                            </a>
                                            <a href="edit_article.php?id=<?= $article['id'] ?>"
                                               class="btn btn-sm btn-warning" title="Éditer">
                                                ✏️
                                            </a>
                                            <button class="btn btn-sm btn-danger"
                                                    onclick="confirmDelete(<?= $article['id'] ?>, '<?= htmlspecialchars(substr($article['title'], 0, 30)) ?>')"
                                                    title="Supprimer">
                                                🗑️
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">📊 Statistiques</h5>
                    <p>Total d'articles: <strong><?= count($articles) ?></strong></p>
                </div>
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
