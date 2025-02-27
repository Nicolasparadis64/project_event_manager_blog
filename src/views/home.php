<div class="header-image w-full h-screen bg-cover bg-center flex items-center relative top-0" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(/project_event_manager_blog/public/image/conference2.jpg);">
    <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">

        <h1 class="heading-1">
            <span>
                La solution de billetterie idéale pour votre
            </span>
            <br>
            <span id="typed"></span>
        </h1>


        <!-- <h1 >Lorem ipsum</h1>
            <p class="text-white text-lg mb-6">Découvrez nos événements et rejoignez notre communauté aujourd'hui.</p>
            <a href="?view=events" class="bg-gray-800 hover:bg-gray-900 transition duration-300 text-white font-bold py-2 px-6 rounded ">
                Explorer
            </a> -->
    </div>
</div>



<?php
require_once __DIR__ . '/../../src/views/events/carrousel.php';
?>


<section class="pb-12 mx-auto">
    <div class="mx-auto md:my-12 lg:my-16">
        <div class="grid md:grid-cols-3 gap-8">
            <div class="col-span-3 p-0">
                <h2 class="text-2xl font-bold mb-6 text-start px-4 md:px-6 lg:px-8">Liste des événements</h2>
                
                <!-- <div class="relative mb-4 px-4 md:px-6 lg:px-8"> -->
                <div class="relative mb-4 px-4 md:px-6 lg:px-8 w-fit">
            <input type="text" id="searchInput" placeholder="Rechercher un événement"
                class="w-full border py-2 px-4 rounded-lg shadow-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            <button class="absolute right-3 top-2 text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </div>
                
                <!-- Liste des événements -->
                <?php if (count($events) > 0): ?>
                    <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mt-6 px-4 md:px-6 lg:px-8" id="eventsList">
                        <?php foreach ($events as $event): ?>
                            <div class="bg-white rounded-lg shadow-lg overflow-hidden h-full flex flex-col">
                                <?php if (isset($event['image']) && !empty($event['image'])): ?>
                                    <div class="h-48 bg-cover bg-center" style="background-image: url('<?= htmlspecialchars($event['image']) ?>')"></div>
                                <?php else: ?>
                                    <div class=" h-48 bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
                                        <span class="text-white text-xl font-bold"><?= htmlspecialchars($event['titre']) ?></span>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="p-6 flex-grow">
                                    <h3 class="text-xl font-bold mb-2"><?= htmlspecialchars($event['titre']) ?></h3>
                                    <p class="text-gray-700 mb-4"><?= htmlspecialchars($event['description']) ?></p>
                                    <div class="flex items-center text-gray-500 text-sm mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span><?= htmlspecialchars($event['date']) ?> à <?= htmlspecialchars($event['heure']) ?></span>
                                    </div>
                                    
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        <span class="text-gray-600"><?= $event['inscrit_count'] ?> inscrits</span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-600 mt-6 px-4 md:px-6 lg:px-8">Aucun événement disponible pour le moment.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>