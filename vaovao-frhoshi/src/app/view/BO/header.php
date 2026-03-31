<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Back-Office' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,400;0,700;1,400&family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-gold: #c9a961;
            --primary-copper: #8b6f47;
            --dark-bg: #1a1a1a;
            --light-bg: #f5f3f0;
            --light-text: #333;
            --border-color: #e8e4df;
            --shadow-light: 0 4px 12px rgba(0, 0, 0, 0.08);
            --shadow-medium: 0 8px 24px rgba(0, 0, 0, 0.12);
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
            background-color: var(--light-bg);
            color: var(--light-text);
            line-height: 1.6;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Merriweather', serif;
            font-weight: 700;
            line-height: 1.3;
        }

        .navbar {
            background-color: var(--dark-bg);
            box-shadow: var(--shadow-light);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-family: 'Merriweather', serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--primary-gold) !important;
            letter-spacing: 0.5px;
        }

        .navbar-text {
            color: #ccc !important;
            font-size: 0.95rem;
        }

        .sidebar {
            background-color: white;
            border-right: 1px solid var(--border-color);
            min-height: calc(100vh - 70px);
            padding: 2rem 0;
            box-shadow: inset -1px 0 0 var(--border-color);
        }

        .sidebar .nav-link {
            color: var(--light-text);
            border-left: 3px solid transparent;
            padding: 0.9rem 1.5rem;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            letter-spacing: 0.3px;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(201, 169, 97, 0.08);
            border-left-color: var(--primary-gold);
            color: var(--primary-gold);
            padding-left: 1.7rem;
        }

        .sidebar .nav-link.active {
            background-color: rgba(201, 169, 97, 0.12);
            border-left-color: var(--primary-gold);
            color: var(--primary-gold);
            font-weight: 600;
            padding-left: 1.7rem;
        }

        .main-content {
            padding: 2.5rem;
            background-color: var(--light-bg);
        }

        .page-title {
            font-family: 'Merriweather', serif;
            color: var(--dark-bg);
            margin-bottom: 2rem;
            font-size: 2.2rem;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .card {
            border: 1px solid var(--border-color);
            border-radius: 12px;
            background-color: white;
            box-shadow: var(--shadow-light);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            box-shadow: var(--shadow-medium);
            transform: translateY(-2px);
        }

        .card-header {
            background-color: var(--light-bg);
            border-bottom: 1px solid var(--border-color);
            padding: 1.5rem;
            font-weight: 600;
            color: var(--dark-bg);
        }

        .card-body {
            padding: 1.5rem;
        }

        .table {
            background-color: white;
            border-collapse: collapse;
        }

        .table thead {
            background-color: var(--light-bg);
            border-bottom: 2px solid var(--border-color);
        }

        .table thead th {
            color: var(--dark-bg);
            font-weight: 600;
            border: none;
            padding: 1rem 0.75rem;
            font-size: 0.92rem;
            letter-spacing: 0.3px;
            text-transform: uppercase;
        }

        .table tbody tr {
            border-bottom: 1px solid var(--border-color);
            transition: background-color 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: rgba(201, 169, 97, 0.05);
        }

        .table tbody td {
            padding: 1rem 0.75rem;
            vertical-align: middle;
        }

        .btn {
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
            letter-spacing: 0.3px;
            text-transform: uppercase;
            font-size: 0.85rem;
            border: none;
        }

        .btn-primary {
            background-color: var(--primary-gold);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-copper);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(139, 111, 71, 0.3);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-success {
            background-color: #27ae60;
            color: white;
        }

        .btn-success:hover {
            background-color: #229954;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(34, 153, 84, 0.3);
        }

        .btn-warning {
            background-color: #f39c12;
            color: white;
        }

        .btn-warning:hover {
            background-color: #e67e22;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(230, 126, 34, 0.3);
        }

        .btn-danger {
            background-color: #e74c3c;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c0392b;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(192, 57, 43, 0.3);
        }

        .btn-outline-light {
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
        }

        .btn-outline-light:hover {
            background-color: var(--primary-gold);
            border-color: var(--primary-gold);
            color: white;
        }

        .btn-sm {
            padding: 0.4rem 0.75rem;
            font-size: 0.8rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--dark-bg);
            margin-bottom: 0.6rem;
            font-size: 0.95rem;
            letter-spacing: 0.2px;
        }

        .form-control,
        .form-select {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 0.7rem 0.9rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 3px rgba(201, 169, 97, 0.1);
        }

        .form-control::placeholder {
            color: #999;
        }

        .alert {
            border: none;
            border-radius: 12px;
            border-left: 4px solid;
            padding: 1.2rem;
        }

        .alert-success {
            background-color: rgba(39, 174, 96, 0.1);
            color: #27ae60;
            border-left-color: #27ae60;
        }

        .alert-danger {
            background-color: rgba(231, 76, 60, 0.1);
            color: #e74c3c;
            border-left-color: #e74c3c;
        }

        .alert-warning {
            background-color: rgba(243, 156, 18, 0.1);
            color: #f39c12;
            border-left-color: #f39c12;
        }

        .alert-info {
            background-color: rgba(52, 152, 219, 0.1);
            color: #3498db;
            border-left-color: #3498db;
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0 0 1.5rem 0;
            margin: 0;
        }

        .breadcrumb-item {
            color: #999;
        }

        .breadcrumb-item.active {
            color: var(--primary-gold);
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .action-buttons a,
        .action-buttons button {
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
            white-space: nowrap;
        }

        .table-actions {
            white-space: nowrap;
        }

        .badge {
            font-weight: 600;
            border-radius: 6px;
            font-size: 0.8rem;
            letter-spacing: 0.2px;
        }

        .badge-primary {
            background-color: rgba(201, 169, 97, 0.2);
            color: var(--primary-copper);
        }

        .badge-success {
            background-color: rgba(39, 174, 96, 0.2);
            color: #27ae60;
        }

        .badge-danger {
            background-color: rgba(231, 76, 60, 0.2);
            color: #e74c3c;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
                padding: 0.5rem 0;
            }

            .sidebar .nav-link {
                padding: 0.7rem 1rem;
                font-size: 0.9rem;
            }

            .main-content {
                padding: 1.5rem;
            }

            .page-title {
                font-size: 1.8rem;
                margin-bottom: 1.5rem;
            }

            .card {
                margin-bottom: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">📊 Vaovao Back-Office</a>
            <span class="navbar-text text-white">Gestion d'articles et administrateurs</span>
            <div class="navbar-text text-white ms-auto">
                <span>👤 <?= htmlspecialchars($admin_nom ?? 'Admin') ?></span>
                <a href="/app/view/BO/logout.php" class="btn btn-sm btn-outline-light ms-2">🚪 Déconnexion</a>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 sidebar">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/admins.php">
                            👤 Gestion Admins
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/vaovaosite/BO/gestion_articles/vaovao-back-office-article-gestion-des-articles">
                            📰 Gestion Articles 
                        </a>
                    </li>
                    <li class="nav-item border-top mt-3 pt-3">
                        <a class="nav-link" href="/">
                            🏠 Retour au site
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 col-lg-10 main-content">
