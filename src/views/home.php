<div class="w-full flex flex-col lg:flex-row h-screen">
    <!-- Image à gauche - prend la moitié de l'écran sur desktop -->
    <div class="w-full lg:w-1/2 relative">
        <div class="w-full h-full bg-cover bg-center absolute" 
             style="background-image: url(/project_event_manager_blog/public/image/conference2.jpg); filter: brightness(0.7);">
        </div>
    </div>
    
    <!-- Contenu à droite -->
    <div class="w-full lg:w-2/3 flex items-center justify-center bg-gray-50 px-8 py-16 lg:py-0">
        <div class="max-w-xl">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">
                La solution de billetterie idéale pour votre
                <span id="typed" class="text-blue-600"></span>
            </h1>
            <p class="text-gray-600 mb-8 text-lg">
                Gérez vos événements en toute simplicité. Inscrivez-vous, suivez vos participants et créez des expériences mémorables.
            </p>
            <a href="?view=events" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition duration-300 inline-flex items-center">
                Commencer une démo
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </div>
</div>





<?php
require_once __DIR__ . '/../../src/views/home/caracteristiques.php'
?>

<?php
require_once __DIR__ . '/../../src/views/events/carrousel.php';
?>

<section class="pb-12 mx-auto">
    <div class="mx-auto md:my-12 lg:my-16">
        <div class="grid md:grid-cols-3 gap-8">
            <div class="col-span-3 p-0">
                <h2 class="text-2xl font-bold mb-6 text-start px-4 md:px-6 lg:px-8">Liste des événements</h2>

                <!-- Liste des événements -->
                <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mt-6 px-4 md:px-6 lg:px-8" id="eventsList">
                    <?php foreach ($events as $event): ?>
                        <?php
                        $date = new DateTime($event['date']);
                        $heure = new DateTime($event['heure']);
                        $isRegistered = false;

                        // Check if user is registered
                        if (isset($_SESSION['user'])) {
                            $stmt = $pdo->prepare('
                        SELECT COUNT(*) 
                        FROM register 
                        WHERE id_utilisateur = :id_utilisateur AND id_evenement = :id_evenement
                    ');
                            $stmt->execute([
                                'id_utilisateur' => $_SESSION['user']['id'],
                                'id_evenement' => $event['id_evenement'],
                            ]);
                            $isRegistered = $stmt->fetchColumn() > 0;
                        }
                        ?>
                            <a href="?view=view_event&id=<?= $event['id_evenement'] ?>" class="block">
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <!-- Image de l'événement -->
                            <?php if (!empty($event['image_path'])): ?>
                                <div class="h-48 w-full overflow-hidden">
                                    <img src="<?= htmlspecialchars($event['image_path']) ?>" alt="<?= htmlspecialchars($event['titre']) ?>"
                                        class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                                </div>
                            <?php else: ?>
                                <div class="h-48 w-full bg-gray-200 flex items-center justify-center">
                                    <svg class="h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            <?php endif; ?>

                            <div class="px-4 py-5 sm:p-6">
                                <div class="flex justify-between items-start">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                        <?= htmlspecialchars($event['titre']) ?>
                                    </h3>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <?= $event['inscrit_count'] ?> inscrit(s)
                                    </span>
                                </div>

                                <div class="mt-2 text-sm text-gray-500">
                                    <p><?= nl2br(htmlspecialchars($event['description'])) ?></p>
                                </div>

                                <div class="mt-3 flex items-center text-sm text-gray-500">
                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                    </svg>
                                    <span><?= $date->format('d/m/Y') ?> à <?= $heure->format('H:i') ?></span>
                                </div>

                                <div class="mt-1 flex items-center text-sm text-gray-500">
                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                    </svg>
                                    <span><?= htmlspecialchars($event['lieu']) ?></span>
                                </div>

                                <div class="mt-5 flex">
                                    <?php if (isset($_SESSION['user'])): ?>
                                        <?php if ($isRegistered): ?>
                                            <form action="?view=unregister_event" method="POST" style="display: inline;">
                                                <input type="hidden" name="event_id" value="<?= $event['id_evenement'] ?>">
                                                <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                    Se désinscrire
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <form action="?view=register_event" method="POST" style="display: inline;">
                                                <input type="hidden" name="event_id" value="<?= $event['id_evenement'] ?>">
                                                <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                    S'inscrire
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if (isset($adminController) && $adminController->isAdmin()): ?>
                                        <a href="?view=update_event&id=<?= $event['id_evenement'] ?>" class="ml-auto inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Modifier
                                        </a>
                                        <form action="?view=delete" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet événement?');">
                                            <input type="hidden" name="id" value="<?= $event['id_evenement'] ?>">
                                            <button type="submit" class="ml-2 inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                Supprimer
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        </a>
                    <?php endforeach; ?>
                </div>

            
            </div>
        </div>
    </div>
</section>