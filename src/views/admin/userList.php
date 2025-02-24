<h1 class="text-xl font-bold mb-4">Liste des utilisateurs</h1>


<!-- <?php print_r($users); ?> -->


<table class="min-w-full table-auto">
    <thead>
        <tr>
            <th class="px-4 py-2">ID</th>
            <th class="px-4 py-2">Nom</th>
            <th class="px-4 py-2">Email</th>
            <th class="px-4 py-2">Rôle</th>
            <th class="px-4 py-2">Date d'inscription</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td class="border px-4 py-2"><?= htmlspecialchars($user['id_utilisateur'] ?? '') ?></td>
                <td class="border px-4 py-2"><?= htmlspecialchars($user['nom'] ?? '') ?></td>
                <td class="border px-4 py-2"><?= htmlspecialchars($user['email'] ?? '') ?></td>
                <td class="border px-4 py-2"><?= htmlspecialchars($user['role'] ?? '') ?></td>
                <td class="border px-4 py-2"><?= htmlspecialchars((new DateTime($user['date_inscription']))->format('d/m/Y H:i')) ?></td>
                <td class="border px-4 py-2">
                    <a href="?view=updateUser&id=<?= htmlspecialchars($user['id_utilisateur'] ?? '') ?>" class="text-blue-500">Modifier</a>
                    <a href="?view=deleteUser&id=<?= htmlspecialchars($user['id_utilisateur'] ?? '') ?>" class="text-red-500" onclick="return confirm('Confirmer la suppression ?');">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="?view=createUser" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">Créer un utilisateur</a>