<?php
require_once 'layout/header.php';
require_once 'back/db.php';
require_once 'router/router.php';

try {
    $stmt = $pdo->query("
        SELECT e.*, l.ville, l.adresse 
        FROM event e 
        LEFT JOIN Avoir a ON e.id_evenement = a.id_evenement
        LEFT JOIN lieu l ON a.id_lieu = l.id_lieu 
        ORDER BY e.date DESC
        LIMIT 6
    ");
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log($e->getMessage(), 3, '/path/to/logfile.log'); // Log erreur
    echo "Une erreur est survenue. Veuillez réessayer plus tard.";
}
?>

<div class="bg-white rounded-lg shadow-xl p-6 mb-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-4">Événements à venir</h1>
    
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
   
        <?php foreach ($events as $event): ?>
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">
                        <?= htmlspecialchars($event['titre']) ?>
                    </h3>
                    <p class="text-gray-600 mb-4">
                        <?= htmlspecialchars(substr($event['description'], 0, 100)) ?>...
                    </p>
                    <div class="flex items-center text-sm text-gray-500">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <?= date('d/m/Y', strtotime($event['date'])) ?> à <?= $event['heure'] ?>
                    </div>
                    <div class="mt-4">
                        <a href="/events/view.php?id=<?= $event['id_evenement'] ?>" 
                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            Voir les détails
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once 'layout/footer.php'; ?>