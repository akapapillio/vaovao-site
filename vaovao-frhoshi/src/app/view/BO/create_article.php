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
    $featured_image = '';

    if (empty($title)) {
        $error = 'Le titre est requis.';
    } elseif (empty($content)) {
        $error = 'Le contenu est requis.';
    } else {
        try {
            // Traiter l'upload de l'image
            if (!empty($_FILES['featured_image']['name'])) {
                $file = $_FILES['featured_image'];
                
                // Validation du fichier
                $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                
                if (!in_array($file_ext, $allowed)) {
                    throw new Exception('Format de fichier non autorisé. Formats acceptés: jpg, jpeg, png, gif, webp');
                }
                
                if ($file['size'] > 5 * 1024 * 1024) { // 5 MB max
                    throw new Exception('La taille du fichier ne doit pas dépasser 5 MB');
                }
                
                if ($file['error'] !== UPLOAD_ERR_OK) {
                    throw new Exception('Erreur lors de l\'upload du fichier');
                }
                
                // Créer un nom unique pour le fichier
                $upload_dir = dirname(__DIR__, 3) . '/uploads/';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }
                
                $new_filename = 'article_' . time() . '_' . uniqid() . '.' . $file_ext;
                $upload_path = $upload_dir . $new_filename;
                
                if (!move_uploaded_file($file['tmp_name'], $upload_path)) {
                    throw new Exception('Erreur lors de la sauvegarde du fichier');
                }
                
                $featured_image = '/uploads/' . $new_filename;
            }
            
            $controller->create($title, $content, '', $featured_image);
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
            <li class="breadcrumb-item"><a href="/vaovaosite/BO/gestion_articles/vaovao-back-office-article-gestion-des-articles">Articles</a></li>
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
            <form method="POST" id="articleForm" enctype="multipart/form-data">
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

                <!-- Image de couverture -->
                <div class="mb-3">
                    <label for="featured_image" class="form-label">Image de couverture (optionnel)</label>
                    <input type="file"
                           class="form-control"
                           id="featured_image"
                           name="featured_image"
                           accept="image/*">
                    <small class="text-muted">Formats acceptés: JPG, PNG, GIF, WebP. Taille max: 5 MB</small>
                    <div id="imagePreview" style="margin-top: 1rem; display: none;">
                        <img id="previewImg" src="" alt="Aperçu" style="max-width: 300px; max-height: 300px; border-radius: 4px;">
                    </div>
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

        // Prévisualisation de l'image
        document.getElementById('featured_image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('previewImg').src = event.target.result;
                    document.getElementById('imagePreview').style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                document.getElementById('imagePreview').style.display = 'none';
            }
        });
    </script>

<?php include 'footer.php'; ?>
