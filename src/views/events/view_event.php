<div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto bg-white shadow overflow-hidden sm:rounded-lg">
        <!-- En-tête avec titre et bouton retour -->
        <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900"><?= htmlspecialchars($event['titre']) ?></h1>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    <?php
                    $date = new DateTime($event['date']);
                    $heure = new DateTime($event['heure']);
                    echo $date->format('d/m/Y') . ' à ' . $heure->format('H:i');
                    ?>
                </p>
            </div>
            <a href="?view=events" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="-ml-0.5 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Retour aux événements
            </a>
        </div>
        
        <!-- Image de l'événement -->
        <?php if (!empty($event['image_path'])): ?>
            <div class="w-full h-64 md:h-96 overflow-hidden">
                <img src="<?= htmlspecialchars($event['image_path']) ?>" alt="<?= htmlspecialchars($event['titre']) ?>"
                    class="w-full h-full object-cover">
            </div>
        <?php endif; ?>
        
        <!-- Informations détaillées -->
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Description</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <?= nl2br(htmlspecialchars($event['description'])) ?>
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Lieu</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <?= htmlspecialchars($event['lieu']) ?>
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Participants</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <?= $event['inscrit_count'] ?> inscrit(s)
                    </dd>
                </div>
            </dl>
        </div>
        
        <!-- Actions -->
        <div class="bg-white px-4 py-5 sm:px-6 border-t border-gray-200">
            <div class="flex justify-between items-center">
                <?php if (isset($_SESSION['user'])): ?>
                    <?php if ($isRegistered): ?>
                        <form action="?view=unregister_event" method="POST">
                            <input type="hidden" name="event_id" value="<?= $event['id_evenement'] ?>">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Se désinscrire
                            </button>
                        </form>
                    <?php else: ?>
                        <form action="?view=register_event" method="POST">
                            <input type="hidden" name="event_id" value="<?= $event['id_evenement'] ?>">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                S'inscrire
                            </button>
                        </form>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="?view=login" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Connexion pour s'inscrire
                    </a>
                <?php endif; ?>
                
                <?php if (isset($adminController) && $adminController->isAdmin()): ?>
                    <div>
                        <a href="?view=update_event&id=<?= $event['id_evenement'] ?>" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Modifier
                        </a>
                        <form action="?view=delete" method="POST" class="inline-block ml-2" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet événement?');">
                            <input type="hidden" name="id" value="<?= $event['id_evenement'] ?>">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Supprimer
                            </button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>