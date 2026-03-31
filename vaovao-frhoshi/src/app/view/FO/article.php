<?php
require_once dirname(__DIR__, 3) . '/config/bootstrap.php';
require_once 'check_user_auth.php';
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
                    <!-- Image de couverture -->
                    <?php if (!empty($article['featured_image'])): ?>
                        <div style="margin-bottom: 2.5rem; text-align: center; margin-left: -3rem; margin-right: -3rem; margin-top: -3rem; width: calc(100% + 6rem);">
                            <img src="<?= htmlspecialchars($article['featured_image']) ?>" 
                                 alt="<?= htmlspecialchars($article['title']) ?>"
                                 style="width: 100%; height: auto; max-height: 400px; object-fit: cover;">
                        </div>
                    <?php endif; ?>

                    <!-- Meta informations -->
                    <div class="article-detail-meta">
                        <div>
                            <strong>📅</strong> <?= date('d/m/Y', strtotime($article['created_at'])) ?>
                        </div>
                        <div>
                            <strong>🕐</strong> Lecture: ~5 min
                        </div>
                        <div>
                            <strong>🆔</strong> Article #<?= $article['id'] ?>
                        </div>
                    </div>

                    <!-- Contenu -->
                    <div class="article-detail-content">
                        <?php
                        // Convertir les paragraphes en balises <p>
                        $content = htmlspecialchars_decode($article['content']);
                        $paragraphes = array_filter(array_map('trim', explode("\n", $content)));
                        foreach ($paragraphes as $para):
                            if (!empty($para)):
                                echo '<p>' . nl2br($para) . '</p>';
                            endif;
                        endforeach;
                        ?>
                    </div>

                    <!-- Actions -->
                    <div style="margin-top: 3rem; padding-top: 2rem; border-top: 2px solid var(--border-light);">
                        <a href="/" class="btn btn-read-more">
                            ← Retour aux articles
                        </a>
                    </div>
                </article>
            </div>
        </div>

        <!-- Articles similaires -->
        <div class="row mt-5">
            <div class="col-md-12">
                <h3 style="font-family: 'Merriweather', serif; color: var(--accent-gold); margin-bottom: 2rem; font-size: 1.8rem; font-weight: 700;">Articles connexes</h3>
                <p style="color: var(--text-light);">Découvrez d'autres articles qui pourraient vous intéresser.</p>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>
