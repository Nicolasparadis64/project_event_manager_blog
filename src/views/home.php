<div class="max-w-7xl mx-auto mt-6">
    <h2 class="text-2xl font-bold mb-4">Liste des événements</h2>
    <?php if (count($events) > 0): ?>
        <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            <?php foreach ($events as $event): ?>
                <div class="bg-white p-4 rounded shadow">
                    <h3 class="text-xl font-bold"><?= htmlspecialchars($event['titre']) ?></h3>
                    <p class="text-gray-700"><?= htmlspecialchars($event['description']) ?></p>
                    <p class="text-gray-500 text-sm"><?= htmlspecialchars($event['date']) ?> à <?= htmlspecialchars($event['heure']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-gray-600">Aucun événement disponible pour le moment.</p>
    <?php endif; ?>
</div>
