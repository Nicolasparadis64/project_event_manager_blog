<div class="header-image w-full h-screen bg-cover bg-center flex items-center" style="background-image: url(/project_event_manager/public/image/conference2.jpg);">
    <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
        <div class="header-content text-left md:w-1/2 p-6">
            <h1 class="text-white text-4xl md:text-5xl font-bold mb-4">Lorem ipsum</h1>
            <p class="text-white text-lg mb-6">Découvrez nos événements et rejoignez notre communauté aujourd'hui.</p>
            <a href="?view=events" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition duration-300">
                Explorer
            </a>
        </div>
    </div>
</div>

<div class="mt-6 flex justify-center px-4">
    <div class="relative w-full max-w-md">
        <input type="text" id="searchInput" placeholder="Rechercher un événement" class="w-full border py-2 px-4 rounded-lg shadow-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        <button class="absolute right-3 top-2 text-gray-500 hover:text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </button>
    </div>
</div>
<div class="max-w-7xl mx-auto mt-6 px-4">
            <h2 class="text-2xl font-bold mb-4">Liste des événements</h2>
            <?php if (count($events) > 0): ?>
                <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3" id="eventsList">
                    <?php foreach ($events as $event): ?>
                        <div class="bg-white p-4 rounded shadow event-card">
                            <h3 class="text-xl font-bold"><?= htmlspecialchars($event['titre']) ?></h3>
                            <p class="text-gray-700"><?= htmlspecialchars($event['description']) ?></p>
                            <p class="text-gray-500 text-sm"><?= htmlspecialchars($event['date']) ?> à <?= htmlspecialchars($event['heure']) ?></p>
                            <p class="text-gray-600 font-medium mt-4">Inscrits :</p>
                            <p class="text-gray-700"><?= $event['inscrit_count'] ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-gray-600">Aucun événement disponible pour le moment.</p>
            <?php endif; ?>
        </div>