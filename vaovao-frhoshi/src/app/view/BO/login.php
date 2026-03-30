<?php
require_once dirname(__DIR__, 3) . '/config/bootstrap.php';
require_once dirname(__DIR__, 3) . '/app/controllers/AdminController.php';
require_once dirname(__DIR__, 3) . '/app/controllers/UserController.php';

$error = '';
$success = '';
$login_type = $_GET['type'] ?? 'admin'; // admin ou user

// Traiter le formulaire de login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($nom) || empty($password)) {
        $error = 'Le nom et le mot de passe sont requis.';
    } else {
        if ($login_type === 'user') {
            // === LOGIN USER ===
            $userController = new UserController();
            $user = $userController->getUserByNom($nom);

            if ($user && password_verify($password, $user['password'])) {
                // Authentification réussie
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_nom'] = $user['nom'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['role'] = 'user';

                // header('Location: /');
                header('Location: /vvm/FO/Accueil-vaovao-malaza-ary-marina-actualités-analyses-situation-iran-impacts-géopolitiques-guerre-escalade-acteurs');
                exit;
            } else {
                $error = 'Nom ou mot de passe incorrect.';
            }
        } else {
            // === LOGIN ADMIN ===
            $adminController = new AdminController();
            $admins = $adminController->index();

            $admin_found = null;
            foreach ($admins as $admin) {
                if ($admin['nom'] === $nom) {
                    $admin_found = $admin;
                    break;
                }
            }

            if ($admin_found && isset($admin_found['password'])) {
                if (password_verify($password, $admin_found['password'])) {
                    // Authentification réussie
                    $_SESSION['admin_id'] = $admin_found['id'];
                    $_SESSION['admin_nom'] = $admin_found['nom'];
                    $_SESSION['admin_email'] = $admin_found['email'] ?? '';
                    $_SESSION['role'] = 'admin';

                    header('Location: articles.php');
                    exit;
                } else {
                    $error = 'Mot de passe incorrect.';
                }
            } else {
                $error = 'Administrateur non trouvé.';
            }
        }
    }
}

// Si déjà connecté, rediriger
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {
        header('Location: articles.php');
    } else {
        header('Location: /');
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Vaovao</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #dc3545;
            --secondary-color: #6c757d;
        }

        body {
            background: linear-gradient(135deg, var(--primary-color) 0%, #c82333 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-wrapper {
            max-width: 1000px;
            width: 100%;
            padding: 1rem;
        }

        .login-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .login-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
        }

        .login-form-section {
            padding: 3rem;
            display: flex;
            flex-direction: column;
        }

        .login-info-section {
            background-color: #f8f9fa;
            padding: 3rem;
            border-left: 1px solid #ddd;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-header {
            margin-bottom: 2rem;
        }

        .login-header h1 {
            color: var(--primary-color);
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .login-header p {
            color: #666;
            margin: 0;
            font-size: 0.95rem;
        }

        .role-tabs {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 2rem;
            border-bottom: 2px solid #ddd;
        }

        .role-tab {
            padding: 0.75rem 1rem;
            background: none;
            border: none;
            color: #999;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border-bottom: 3px solid transparent;
            position: relative;
            bottom: -2px;
        }

        .role-tab.active {
            color: var(--primary-color);
            border-bottom-color: var(--primary-color);
        }

        .role-tab:hover {
            color: var(--primary-color);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control {
            border: 2px solid #ddd;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

        .btn-login {
            background-color: var(--primary-color);
            border: none;
            color: white;
            font-weight: 600;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            width: 100%;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-login:hover {
            background-color: #c82333;
            color: white;
        }

        .alert {
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .info-section h3 {
            color: var(--primary-color);
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .info-box {
            background-color: white;
            border-left: 4px solid var(--primary-color);
            padding: 1rem;
            border-radius: 0 8px 8px 0;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            color: #666;
        }

        .info-box strong {
            color: #333;
        }

        .info-box code {
            background-color: #f0f0f0;
            padding: 0.2rem 0.4rem;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
        }

        .back-link {
            text-align: center;
            margin-top: 1.5rem;
        }

        .back-link a {
            color: #666;
            text-decoration: none;
            font-size: 0.95rem;
        }

        .back-link a:hover {
            color: var(--primary-color);
        }

        @media (max-width: 768px) {
            .login-content {
                grid-template-columns: 1fr;
            }

            .login-info-section {
                border-left: none;
                border-top: 1px solid #ddd;
                order: 2;
                padding: 2rem;
            }

            .login-form-section {
                padding: 2rem;
                order: 1;
            }
        }

        .role-description {
            color: #666;
            font-size: 0.9rem;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-container">
            <div class="login-content">
                <!-- Formulaire de connexion -->
                <div class="login-form-section">
                    <div class="login-header">
                        <h1><?= $login_type === 'admin' ? '🔐 Admin' : '👤 Utilisateur' ?></h1>
                        <p>Connectez-vous à votre compte</p>
                    </div>

                    <!-- Messages d'erreur/succès -->
                    <?php if ($error): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>✗ Erreur!</strong> <?= htmlspecialchars($error) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Onglets de rôle -->
                    <div class="role-tabs">
                        <button class="role-tab <?= $login_type === 'admin' ? 'active' : '' ?>"
                                onclick="switchTab('admin')">
                            🔐 Admin
                        </button>
                        <button class="role-tab <?= $login_type === 'user' ? 'active' : '' ?>"
                                onclick="switchTab('user')">
                            👤 Utilisateur
                        </button>
                    </div>

                    <!-- Formulaire -->
                    <form method="POST" id="loginForm">
                        <!-- Nom -->
                        <div class="form-group">
                            <label for="nom" class="form-label">
                                <?= $login_type === 'admin' ? '👤 Nom d\'administrateur' : '👤 Nom d\'utilisateur' ?>
                            </label>
                            <input type="text"
                                   class="form-control"
                                   id="nom"
                                   name="nom"
                                   placeholder="<?= $login_type === 'admin' ? 'Ex: admin' : 'Ex: user' ?>"
                                   required
                                   autofocus>
                        </div>

                        <!-- Mot de passe -->
                        <div class="form-group">
                            <label for="password" class="form-label">🔑 Mot de passe</label>
                            <input type="password"
                                   class="form-control"
                                   id="password"
                                   name="password"
                                   placeholder="Entrez votre mot de passe"
                                   required>
                        </div>

                        <!-- Description du rôle -->
                        <div class="role-description">
                            <?php if ($login_type === 'admin'): ?>
                                <strong>⚡ Admin:</strong> Accès complet au back-office, gestion des articles et administrateurs.
                            <?php else: ?>
                                <strong>📖 Utilisateur:</strong> Accès à la consultation des articles uniquement.
                            <?php endif; ?>
                        </div>

                        <!-- Bouton de connexion -->
                        <button type="submit" class="btn-login mt-3">
                            ✓ Se connecter
                        </button>
                    </form>

                    <!-- Lien retour -->
                    <div class="back-link">
                        <a href="/">🏠 Retour au site</a>
                    </div>
                </div>

                <!-- Section d'information -->
                <div class="login-info-section">
                    <div class="info-section">
                        <h3><?= $login_type === 'admin' ? '🔐 Comptes Admin' : '👤 Comptes Utilisateur' ?></h3>

                        <?php if ($login_type === 'admin'): ?>
                            <div class="info-box">
                                <strong>Admin par défaut:</strong><br>
                                Nom: <code>admin2</code><br>
                                Email: <code>admin2@mail.com</code><br>
                                Password: <code>admin123</code>
                            </div>
                            <div class="info-box">
                                <strong>ℹ️ Droits:</strong><br>
                                • Gestion complète des articles<br>
                                • Gestion des administrateurs<br>
                                • Accès au back-office<br>
                                • Éditeur riche (TinyMCE)
                            </div>
                        <?php else: ?>
                            <div class="info-box">
                                <strong>Utilisateur par défaut:</strong><br>
                                Nom: <code>user</code><br>
                                Email: <code>user@mail.com</code><br>
                                Password: <code>user123</code>
                            </div>
                            <div class="info-box">
                                <strong>ℹ️ Droits:</strong><br>
                                • Lecture articles<br>
                                • Consultation du site<br>
                                • Accès à la page d'accueil<br>
                                • Pas d'accès au back-office
                            </div>
                        <?php endif; ?>

                        <div class="info-box" style="background-color: #fff3cd; border-left-color: #ff9800;">
                            <strong style="color: #856404;">💡 Conseil:</strong><br>
                            Cliquez sur l'autre onglet pour changer de type de compte.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function switchTab(type) {
            window.location.href = `?type=${type}`;
        }
    </script>
</body>
</html>
