<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Vaovao - Actualités' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #dc3545;
            --secondary-color: #6c757d;
            --light-bg: #f8f9fa;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-bg);
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, #c82333 100%);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .nav-link {
            font-weight: 500;
            margin-left: 1rem;
            transition: opacity 0.3s ease;
        }

        .nav-link:hover {
            opacity: 0.8;
        }

        .hero {
            background: linear-gradient(135deg, var(--primary-color) 0%, #c82333 100%);
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .hero h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.1rem;
            opacity: 0.95;
        }

        .article-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .article-card-header {
            background-color: var(--primary-color);
            color: white;
            padding: 1.5rem;
            border-bottom: 3px solid #c82333;
        }

        .article-card-title {
            font-size: 1.3rem;
            font-weight: 600;
            line-height: 1.4;
            margin: 0;
        }

        .article-date {
            font-size: 0.85rem;
            opacity: 0.9;
            margin-top: 0.5rem;
        }

        .article-card-body {
            padding: 1.5rem;
            flex-grow: 1;
        }

        .article-card-text {
            color: #555;
            line-height: 1.6;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 80px;
        }

        .btn-read-more {
            background-color: var(--primary-color);
            border: none;
            font-weight: 600;
            margin-top: 1rem;
            transition: background-color 0.3s ease;
        }

        .btn-read-more:hover {
            background-color: #c82333;
        }

        .article-detail {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .article-detail h1 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .article-detail-meta {
            color: #666;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--light-bg);
        }

        .article-detail-content {
            line-height: 1.8;
            color: #444;
        }

        .pagination-custom .page-link {
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
        }

        .pagination-custom .page-link:hover {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .pagination-custom .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        footer {
            background-color: #222;
            color: #ccc;
            padding: 2rem 0;
            margin-top: 3rem;
            border-top: 3px solid var(--primary-color);
        }

        footer a {
            color: var(--primary-color);
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .no-articles {
            text-align: center;
            padding: 3rem 1rem;
            color: #666;
        }

        .no-articles h3 {
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 1.8rem;
            }

            .article-card-title {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/">V . M . M</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Accueil</a>
                    </li>
                    <?php if (isset($current_role) && $current_role === 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/vaovaosite/BO/gestion_articles/vaovao-back-office-article-gestion-des-articles">Gestion Articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/admins.php">Gestion Admins</a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            👤 <?= htmlspecialchars($current_user_nom ?? 'Utilisateur') ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><span class="dropdown-item-text">Rôle: <strong><?= $current_role === 'admin' ? '🔐 Admin' : '👤 Utilisateur' ?></strong></span></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/app/view/BO/logout.php">🚪 Déconnexion</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
