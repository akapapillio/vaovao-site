<?php
require_once __DIR__ . "/../config/bootstrap.php";

// Créer l'instance du controller
$controller = new AdminController();

// Création admin
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->create($_POST['nom'], $_POST['email'], $_POST['password']);
    header("Location: admins.php");
    exit;
}

// Suppression admin
if (isset($_GET['delete'])) {
    $controller->delete($_GET['delete']);
    header("Location: admins.php");
    exit;
}

// Lecture des admins
$admins = $controller->index();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Admins</title>
</head>
<body>
    <h1>Gestion des Admins</h1>

    <h2>Ajouter un admin</h2>
    <form method="POST">
        Nom : <input name="nom" required><br>
        Email : <input name="email" type="email" required><br>
        Password : <input name="password" type="password" required><br>
        <button type="submit">Créer</button>
    </form>

    <h2>Liste des admins</h2>
    <?php if (!empty($admins)): ?>
        <table border="1" cellpadding="5">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            <?php foreach ($admins as $admin): ?>
            <tr>
                <td><?= htmlspecialchars($admin['id']) ?></td>
                <td><?= htmlspecialchars($admin['nom']) ?></td>
                <td><?= htmlspecialchars($admin['email']) ?></td>
                <td>
                    <a href="?delete=<?= $admin['id'] ?>" onclick="return confirm('Supprimer cet admin ?')">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Aucun admin pour l'instant.</p>
    <?php endif; ?>
</body>
</html>