<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des événements</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-center mb-8">Liste des événements</h1>

        <table class="min-w-full bg-white rounded-md shadow-md overflow-hidden">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Titre</th>
                    <th class="py-3 px-6 text-left">Description</th>
                    <th class="py-3 px-6 text-left">Date</th>
                    <th class="py-3 px-6 text-left">Heure</th>
                    <th class="py-3 px-6 text-left">Lieu</th>
                    <?php if ($adminController->isAdmin()): ?>
                        <th class="py-3 px-6 text-left">Action</th>
                        <th class="py-3 px-6 text-left">Action</th>
                    <?php endif; ?>
                    <th class="py-3 px-6 text-left">Inscription</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                <?php foreach ($events as $event): ?>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left"><?= htmlspecialchars($event['titre']) ?></td>
                        <td class="py-3 px-6 text-left"><?= htmlspecialchars($event['description']) ?></td>
                        <td class="py-3 px-6 text-left"><?= htmlspecialchars($event['date']) ?></td>
                        <td class="py-3 px-6 text-left"><?= htmlspecialchars($event['heure']) ?></td>
                        <td class="py-3 px-6 text-left"><?= htmlspecialchars($event['lieu']) ?></td>
                        <?php if ($adminController->isAdmin()): ?>
                            <td class="py-3 px-6 text-left">
                                <form action="?view=delete" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?');">
                                    <input type="hidden" name="id" value="<?= $event['id_evenement'] ?>">
                                    <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                </form>
                            </td>
                            <td>
                            <a href="?view=update_event&id=<?= $event['id_evenement'] ?>">Modifier</a>
                            </td>
                        <?php endif; ?>
                        <td>
                            <form action="?view=register_event" method="POST">
                                <input type="hidden" name="event_id" value="<?= $event['id_evenement'] ?>">
                                <button type="submit">S'inscrire</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>