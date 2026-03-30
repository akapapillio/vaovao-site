<?php
require_once dirname(__DIR__, 3) . '/config/bootstrap.php';
require_once 'check_auth.php';
require_once dirname(__DIR__, 3) . '/app/controllers/ArticleController.php';

$pageTitle = 'Créer un Article - Back-Office';
$error = '';
$controller = new ArticleController();

// Traiter l'envoi du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';

    if (empty($title)) {
        $error = 'Le titre est requis.';
    } elseif (empty($content)) {
        $error = 'Le contenu est requis.';
    } else {
        try {
            $controller->create($title, $content);
            header('Location: articles.php?success=created');
            exit;
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
}

include 'header.php';
?>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Accueil</a></li>
            <li class="breadcrumb-item"><a href="articles.php">Articles</a></li>
            <li class="breadcrumb-item active">Créer un article</li>
        </ol>
    </nav>

    <h1 class="page-title">✏️ Créer un nouvel article</h1>

    <?php if ($error): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>✗ Erreur!</strong> <?= htmlspecialchars($error) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <form method="POST" id="articleForm">
                <!-- Titre -->
                <div class="mb-3">
                    <label for="title" class="form-label">Titre de l'article</label>
                    <input type="text"
                           class="form-control"
                           id="title"
                           name="title"
                           placeholder="Ex: La situation actuelle en Iran..."
                           required>
                    <small class="text-muted">Minimum 3 caractères</small>
                </div>

                <!-- Contenu avec TinyMCE -->
                <div class="mb-3">
                    <label for="content" class="form-label">Contenu de l'article</label>
                    <textarea id="content" name="content" class="form-control" rows="10" required></textarea>
                </div>

                <!-- Boutons -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">
                        ✓ Créer l'article
                    </button>
                    <a href="articles.php" class="btn btn-secondary btn-lg">
                        ✕ Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Chargement de TinyMCE local -->
    <script src="/app/view/BO/tinymce/js/tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '#content',
            license_key: 'gpl',
            language: 'fr_FR',
            height: 500,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'preview', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | fullscreen | help',
            content_css: false,
            body_class: 'tinymce-content',
            setup: function (editor) {
                editor.on('change', function () {
                    tinymce.triggerSave();
                });
            }
        });
    </script>

<?php include 'footer.php'; ?>
