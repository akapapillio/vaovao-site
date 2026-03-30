<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Back-Office' ?></title>
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
            font-size: 1.5rem;
            font-weight: 700;
        }

        .sidebar {
            background-color: white;
            border-right: 1px solid #ddd;
            min-height: 100vh;
            padding: 1.5rem 0;
        }

        .sidebar .nav-link {
            color: #333;
            border-left: 3px solid transparent;
            padding: 0.8rem 1.5rem;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background-color: var(--light-bg);
            border-left-color: var(--primary-color);
            color: var(--primary-color);
        }

        .sidebar .nav-link.active {
            background-color: var(--light-bg);
            border-left-color: var(--primary-color);
            color: var(--primary-color);
            font-weight: 600;
        }

        .main-content {
            padding: 2rem;
        }

        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .table {
            background-color: white;
        }

        .table thead {
            background-color: var(--light-bg);
            border-bottom: 2px solid #ddd;
        }

        .table thead th {
            color: #333;
            font-weight: 600;
            border: none;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
        }

        .btn-primary:hover {
            background-color: #c82333;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

        .alert {
            border: none;
            border-radius: 8px;
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0 0 1rem 0;
        }

        .breadcrumb-item.active {
            color: var(--primary-color);
            font-weight: 600;
        }

        .page-title {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            font-size: 2rem;
            font-weight: 700;
        }

        .action-buttons {
            gap: 0.5rem;
        }

        .action-buttons a,
        .action-buttons button {
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
        }

        .table-actions {
            white-space: nowrap;
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
                <a href="logout.php" class="btn btn-sm btn-outline-light ms-2">🚪 Déconnexion</a>
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
                        <a class="nav-link" href="articles.php">
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
