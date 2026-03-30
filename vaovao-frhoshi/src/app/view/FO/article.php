<?php
require_once dirname(__DIR__, 3) . '/config/bootstrap.php';
require_once dirname(__DIR__, 3) . '/app/controllers/ArticleController.php';

$controller = new ArticleController();
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if (!$id) {
    http_response_code(400);
    die("<p style='text-align: center; margin-top: 50px;'>Erreur: ID d'article manquant</p>");
}

$result = $controller->show($id);

if (isset($result['error'])) {
    http_response_code(404);
    include 'header.php';
    ?>
    <main class="container my-5">
        <div class="article-detail">
            <h1>❌ Article non trouvé</h1>
            <p><?= htmlspecialchars($result['error']) ?></p>
            <a href="/" class="btn btn-primary">← Retour à l'accueil</a>
        </div>
    </main>
    <?php
    include 'footer.php';
    exit;
}

$article = $result['article'];
$pageTitle = htmlspecialchars($article['title']) . ' - Vaovao';

include 'header.php';
?>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1><?= htmlspecialchars($article['title']) ?></h1>
        </div>
    </section>

    <main class="container my-5">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <article class="article-detail">
                    <!-- Meta informations -->
                    <div class="article-detail-meta">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div>
                                <strong>📅 Publié le:</strong>
                                <?= date('d/m/Y à H:i', strtotime($article['created_at'])) ?>
                            </div>
                            <div>
                                <strong>🆔 Article n°</strong> <?= $article['id'] ?>
                            </div>
                        </div>
                    </div>

                    <!-- Contenu -->
                    <div class="article-detail-content">
                        <?= nl2br(htmlspecialchars($article['content'])) ?>
                    </div>

                    <!-- Actions -->
                    <div style="margin-top: 2rem; padding-top: 1rem; border-top: 2px solid #f0f0f0;">
                        <a href="/" class="btn btn-primary">
                            ← Retour aux articles
                        </a>
                    </div>
                </article>
            </div>
        </div>

        <!-- Articles associés (optionnel) -->
        <div class="row mt-5">
            <div class="col-md-12">
                <h3 style="color: #dc3545; margin-bottom: 1.5rem;">Articles similaires</h3>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Vaovao</h5>
                    <p>Plateforme d'informations et d'analyses géopolitiques</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p><strong>Contacts:</strong></p>
                    <p>
                        <a href="mailto:contact@vaovao.com">contact@vaovao.com</a>
                    </p>
                </div>
            </div>
            <hr style="border-color: #444; margin: 1rem 0;">
            <div class="text-center">
                <p>&copy; 2026 Vaovao. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
