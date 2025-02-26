<div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Liste des utilisateurs</h1>
    
    <div class="flex justify-end mb-4">
        <button class="justify-center border border-transparent inline shadow-sm text-sm font-medium text-white bg-gray-800 hover:bg-gray-900 transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 px-4 py-2 rounded">
            <a href="?view=createUser">
                Créer un utilisateur
            </a>
        </button>
    </div>

    <div class="overflow-x-auto rounded-lg shadow">
        <table class="min-w-full bg-white rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-4 text-left">ID</th>
                    <th class="py-3 px-4 text-left">Nom</th>
                    <th class="py-3 px-4 text-left">Email</th>
                    <th class="py-3 px-4 text-left">Rôle</th>
                    <th class="py-3 px-4 text-left">Date d'inscription</th>
                    <th class="py-3 px-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm">
                <?php foreach ($users as $user): ?>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-4 text-left"><?= htmlspecialchars($user['id_utilisateur'] ?? '') ?></td>
                        <td class="py-3 px-4 text-left"><?= htmlspecialchars($user['nom'] ?? '') ?></td>
                        <td class="py-3 px-4 text-left"><?= htmlspecialchars($user['email'] ?? '') ?></td>
                        <td class="py-3 px-4 text-left">
                            <span class="<?= $user['role'] === 'admin' ? 'bg-purple-200 text-purple-800' : 'bg-blue-200 text-blue-800' ?> py-1 px-2 rounded-full text-xs">
                                <?= htmlspecialchars($user['role'] ?? '') ?>
                            </span>
                        </td>
                        <td class="py-3 px-4 text-left"><?= htmlspecialchars((new DateTime($user['date_inscription']))->format('d/m/Y H:i')) ?></td>
                        <td class="py-3 px-4 text-center space-x-2">
                            <a href="?view=updateUser&id=<?= htmlspecialchars($user['id_utilisateur'] ?? '') ?>" class="text-blue-600 hover:underline">Modifier</a>
                            <a href="?view=deleteUser&id=<?= htmlspecialchars($user['id_utilisateur'] ?? '') ?>" class="text-red-600 hover:underline" onclick="return confirm('Confirmer la suppression ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>