<!DOCTYPE html>
<html>
<head>
    <title>Gestion Admin</title>
</head>
<body>

<h1>Gestion des administrateurs</h1>

<a href="create_admin">+ Ajouter un admin</a>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Action</th>
    </tr>

    <?php foreach ($admins as $admin): ?>
    <tr>
        <td><?= $admin['id'] ?></td>
        <td><?= $admin['username'] ?></td>
        <td>
            <a href="delete_admin?id=<?= $admin['id'] ?>">❌ Supprimer</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>