<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Vaovao - Actualités' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700;900&family=Lato:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-dark: #1a1a1a;
            --primary-light: #f5f3f0;
            --accent-gold: #c9a961;
            --accent-copper: #8b6f47;
            --text-dark: #2c2c2c;
            --text-light: #666666;
            --border-light: #e8e6e3;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
        }

        body {
            font-family: 'Lato', sans-serif;
            background-color: var(--primary-light);
            color: var(--text-dark);
            line-height: 1.7;
            display: flex;
            flex-direction: column;
        }

        /* Navigation */
        .navbar {
            background-color: var(--white);
            border-bottom: 2px solid var(--border-light);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            padding: 1.2rem 0;
        }

        .navbar-brand {
            font-family: 'Merriweather', serif;
            font-size: 1.8rem;
            font-weight: 900;
            color: var(--primary-dark) !important;
            letter-spacing: 2px;
        }

        .nav-link {
            font-family: 'Lato', sans-serif;
            font-weight: 500;
            color: var(--text-dark) !important;
            margin-left: 2rem;
            position: relative;
            transition: color 0.3s ease;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--accent-gold);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-link:hover {
            color: var(--accent-gold) !important;
        }

        .nav-link.active {
            color: var(--accent-gold) !important;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--primary-dark) 0%, #2d2d2d 100%);
            color: var(--white);
            padding: 5rem 0;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            right: -50px;
            width: 300px;
            height: 300px;
            background-color: var(--accent-gold);
            opacity: 0.05;
            border-radius: 50%;
        }

        .hero h1 {
            font-family: 'Merriweather', serif;
            font-size: 3rem;
            font-weight: 900;
            margin-bottom: 1rem;
            letter-spacing: -1px;
            line-height: 1.2;
        }

        .hero p {
            font-size: 1.2rem;
            opacity: 0.9;
            font-weight: 300;
            letter-spacing: 0.5px;
        }

        /* Article Cards */
        .article-card {
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            border: none;
            border-radius: 0;
            overflow: hidden;
            background: var(--white);
            height: 100%;
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-top: 3px solid var(--accent-gold);
        }

        .article-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
            border-top-color: var(--accent-copper);
        }

        .article-card-image-wrapper {
            width: 100%;
            height: 240px;
            background-color: var(--border-light);
            overflow: hidden;
            position: relative;
        }

        .article-card-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .article-card:hover .article-card-image-wrapper img {
            transform: scale(1.05);
        }

        .article-card-header {
            background-color: var(--white);
            color: var(--text-dark);
            padding: 1.5rem;
            border-bottom: 1px solid var(--border-light);
        }

        .article-card-title {
            font-family: 'Merriweather', serif;
            font-size: 1.4rem;
            font-weight: 700;
            line-height: 1.4;
            margin: 0 0 0.8rem 0;
            color: var(--primary-dark);
            transition: color 0.3s ease;
        }

        .article-card:hover .article-card-title {
            color: var(--accent-gold);
        }

        .article-date {
            font-size: 0.8rem;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 500;
        }

        .article-card-body {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .article-card-text {
            color: var(--text-light);
            line-height: 1.7;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 1rem;
            font-size: 0.95rem;
            flex-grow: 1;
        }

        .btn-read-more {
            background-color: var(--accent-gold);
            border: none;
            color: var(--white);
            font-weight: 600;
            padding: 0.7rem 1.5rem;
            transition: all 0.3s ease;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 1px;
            align-self: flex-start;
        }

        .btn-read-more:hover {
            background-color: var(--accent-copper);
            transform: translateX(3px);
            color: var(--white) !important;
        }

        /* Article Detail */
        .article-detail {
            background: var(--white);
            padding: 3rem;
            border-radius: 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .article-detail h1 {
            font-family: 'Merriweather', serif;
            color: var(--primary-dark);
            margin-bottom: 1.5rem;
            font-weight: 900;
            font-size: 2.5rem;
            line-height: 1.3;
        }

        .article-detail-meta {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid var(--border-light);
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .article-detail-meta div {
            display: flex;
            gap: 0.5rem;
        }

        .article-detail-content {
            line-height: 2;
            color: var(--text-dark);
            font-size: 1.05rem;
        }

        .article-detail-content p {
            margin-bottom: 1.5rem;
        }

        .article-detail-content h2 {
            font-family: 'Merriweather', serif;
            font-size: 1.8rem;
            font-weight: 700;
            margin: 2rem 0 1rem 0;
            color: var(--primary-dark);
        }

        /* Pagination */
        .pagination-custom {
            margin-top: 3rem;
        }

        .pagination-custom .page-link {
            color: var(--text-dark);
            border: 2px solid var(--border-light);
            background-color: var(--white);
            font-weight: 500;
        }

        .pagination-custom .page-link:hover {
            background-color: var(--accent-gold);
            color: var(--white);
            border-color: var(--accent-gold);
        }

        .pagination-custom .page-item.active .page-link {
            background-color: var(--accent-gold);
            border-color: var(--accent-gold);
        }

        /* Footer */
        footer {
            background-color: var(--primary-dark);
            color: #aaa;
            padding: 3rem 0 1.5rem 0;
            margin-top: auto;
            border-top: 2px solid var(--accent-gold);
        }

        footer h5 {
            font-family: 'Merriweather', serif;
            color: var(--white);
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        footer p {
            font-size: 0.95rem;
            line-height: 1.8;
        }

        footer a {
            color: var(--accent-gold);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: var(--white);
        }

        footer hr {
            border-color: #333;
            margin: 2rem 0;
        }

        footer .text-center {
            border-top: 1px solid #333;
            padding-top: 1.5rem;
            font-size: 0.85rem;
            color: #888;
        }

        /* Empty State */
        .no-articles {
            text-align: center;
            padding: 4rem 1rem;
            color: var(--text-light);
        }

        .no-articles h3 {
            color: var(--accent-gold);
            margin-bottom: 1rem;
            font-family: 'Merriweather', serif;
            font-size: 2rem;
        }

        .no-articles p {
            font-size: 1.1rem;
        }

        /* Alert */
        .alert-info {
            background-color: #f0f7ff;
            border-left: 4px solid var(--accent-gold);
            border-radius: 0;
            color: var(--text-dark);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2rem;
            }

            .article-detail {
                padding: 1.5rem;
            }

            .article-detail h1 {
                font-size: 1.8rem;
            }

            .article-card-title {
                font-size: 1.1rem;
            }

            .nav-link {
                margin-left: 0;
                padding: 0.5rem 0;
            }
        }

        /* Main wrapper */
        main {
            flex: 1;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="/">V A O V A O</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="border: none;">
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
