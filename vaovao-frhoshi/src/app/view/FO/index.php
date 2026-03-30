<?php
require_once dirname(__DIR__, 3) . '/config/bootstrap.php';
require_once dirname(__DIR__, 3) . '/app/controllers/ArticleController.php';

$pageTitle = 'Accueil - Vaovao';
$controller = new ArticleController();
$data = $controller->index();

$articles = $data['articles'];
$currentPage = $data['page'];
$totalPages = $data['total_pages'];
$totalArticles = $data['total_articles'];

include 'header.php';
?>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>🌍 Vaovao Malaza ary Marina</h1>
            <p>Actualités et analyses sur la situation en Iran et ses impacts géopolitiques</p>
        </div>
    </section>

    <main class="container my-5">
        <!-- Statistiques -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="alert alert-info">
                    <strong><?= $totalArticles ?></strong> article<?= $totalArticles > 1 ? 's' : '' ?> disponible<?= $totalArticles > 1 ? 's' : '' ?>
                </div>
            </div>
        </div>

        <!-- Articles Grid -->
        <section id="articles">
            <?php if (empty($articles)): ?>
                <div class="no-articles">
                    <h3>📭 Aucun article disponible</h3>
                    <p>Les articles seront bientôt ajoutés. Veuillez revenir plus tard.</p>
                </div>
            <?php else: ?>
                <div class="row g-4 mb-5">
                    <?php foreach ($articles as $article): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card article-card">
                                <div class="article-card-header">
                                    <h5 class="article-card-title"><?= htmlspecialchars($article['title']) ?></h5>
                                    <small class="article-date">
                                        📅 <?= date('d/m/Y', strtotime($article['created_at'])) ?>
                                    </small>
                                </div>
                                <div class="article-card-body">
                                    <p class="article-card-text">
                                        <?= htmlspecialchars(substr(strip_tags($article['content']), 0, 150)) ?>...
                                    </p>
                                    <a href="/article.php?id=<?= $article['id'] ?>" class="btn btn-sm btn-read-more text-white">
                                        Lire la suite →
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination -->
                <?php if ($totalPages > 1): ?>
                    <nav aria-label="Pagination">
                        <ul class="pagination pagination-custom justify-content-center">
                            <!-- Première page -->
                            <li class="page-item <?= $currentPage == 1 ? 'disabled' : '' ?>">
                                <a class="page-link" href="/?page=1">« Première</a>
                            </li>

                            <!-- Page précédente -->
                            <li class="page-item <?= $currentPage == 1 ? 'disabled' : '' ?>">
                                <a class="page-link" href="/?page=<?= $currentPage - 1 ?>">‹ Précédente</a>
                            </li>

                            <!-- Pages numérotées -->
                            <?php
                            $startPage = max(1, $currentPage - 2);
                            $endPage = min($totalPages, $currentPage + 2);

                            if ($startPage > 1): ?>
                                <li class="page-item disabled">
                                    <span class="page-link">...</span>
                                </li>
                            <?php endif;

                            for ($i = $startPage; $i <= $endPage; $i++): ?>
                                <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                                    <a class="page-link" href="/?page=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php endfor;

                            if ($endPage < $totalPages): ?>
                                <li class="page-item disabled">
                                    <span class="page-link">...</span>
                                </li>
                            <?php endif; ?>

                            <!-- Page suivante -->
                            <li class="page-item <?= $currentPage == $totalPages ? 'disabled' : '' ?>">
                                <a class="page-link" href="/?page=<?= $currentPage + 1 ?>">Suivante ›</a>
                            </li>

                            <!-- Dernière page -->
                            <li class="page-item <?= $currentPage == $totalPages ? 'disabled' : '' ?>">
                                <a class="page-link" href="/?page=<?= $totalPages ?>">Dernière »</a>
                            </li>
                        </ul>
                    </nav>
                <?php endif; ?>
            <?php endif; ?>
        </section>
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
