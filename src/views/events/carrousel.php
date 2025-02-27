<section class="pt-12 mx-auto">
    <div class="mx-auto md:my-12 lg:my-16 ">
        <div class="grid md:grid-cols-3 gap-8 ">
            <?php
            if (!isset($events) || empty($events)) {
                echo '<div class="w-full text-center py-8"><p class="text-gray-600">Aucun événement à afficher dans le carrousel.</p></div>';
            } else {
                $featuredEvents = array_slice($events, 0, min(5, count($events)));
            ?>

                <div class="carousel-container w-full overflow-hidden relative mb-12 col-span-3 p-0">
                    <h2 class=" text-2xl font-bold mb-6 text-start px-4 md:px-6 lg:px-8">Événements à la une</h2>

                    <div class="relative overflow-hidden">
                        <div class="carousel-slides flex transition-transform duration-500 ease-in-out" id="carouselSlides">
                            <?php foreach ($featuredEvents as $index => $event): ?>
                                <div class="carousel-slide " data-index="<?= $index ?>">
                                    <div class="bg-white rounded-lg shadow-lg overflow-hidden h-full flex flex-col">
                                        <?php if (isset($event['image_path']) && !empty($event['image_path'])): ?>
                                            <div class="h-48 bg-cover bg-center" style="background-image: url('<?= htmlspecialchars($event['image_path']) ?>')"></div>
                                        <?php else: ?>
                                            <div class="h-48 bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
                                                <span class="text-white text-xl font-bold"><?= htmlspecialchars($event['titre']) ?></span>
                                            </div>
                                        <?php endif; ?>

                                        <div class="p-6 flex-grow">
                                            <h3 class="text-xl font-bold mb-2"><?= htmlspecialchars($event['titre']) ?></h3>
                                            <p class="text-gray-700 mb-4 line-clamp-2"><?= htmlspecialchars($event['description']) ?></p>
                                            <div class="flex items-center text-gray-500 text-sm mb-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <span><?= htmlspecialchars($event['date']) ?> à <?= htmlspecialchars($event['heure']) ?></span>
                                            </div>

                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center text-gray-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                    </svg>
                                                    <span><?= $event['inscrit_count'] ?> inscrits</span>
                                                </div>
                                                <a href="<?= isset($event['id']) ? '?view=event_details&id=' . htmlspecialchars($event['id']) : '#' ?>"
                                                    class="justify-center border border-transparent inline shadow-sm text-sm font-medium text-white bg-gray-800 hover:bg-gray-900 transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 px-4 py-2 rounded">
                                                    Détails
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <button id="prevBtn" class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-50 hover:bg-opacity-75 rounded-full p-2 shadow-md z-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button id="nextBtn" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-50 hover:bg-opacity-75 rounded-full p-2 shadow-md z-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>

                        <div class="carousel-indicators flex justify-center mt-4">
                            <?php foreach ($featuredEvents as $index => $event): ?>
                                <button class="w-3 h-3 rounded-full mx-1 bg-gray-300 hover:bg-gray-400 transition indicator-btn <?= $index === 0 ? 'bg-blue-600' : '' ?>"
                                    data-index="<?= $index ?>"></button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const slides = document.getElementById('carouselSlides');
                        const prevBtn = document.getElementById('prevBtn');
                        const nextBtn = document.getElementById('nextBtn');
                        const indicators = document.querySelectorAll('.indicator-btn');
                        const slideCount = <?= count($featuredEvents) ?>;
                        let currentIndex = 0;

                        function updateCarousel() {
                            slides.style.transform = `translateX(-${currentIndex * 100}%)`;

                            indicators.forEach((indicator, index) => {
                                if (index === currentIndex) {
                                    indicator.classList.add('bg-blue-600');
                                    indicator.classList.remove('bg-gray-300');
                                } else {
                                    indicator.classList.remove('bg-blue-600');
                                    indicator.classList.add('bg-gray-300');
                                }
                            });
                        }

                        prevBtn.addEventListener('click', function() {
                            currentIndex = (currentIndex - 1 + slideCount) % slideCount;
                            updateCarousel();
                        });

                        nextBtn.addEventListener('click', function() {
                            currentIndex = (currentIndex + 1) % slideCount;
                            updateCarousel();
                        });

                        indicators.forEach(indicator => {
                            indicator.addEventListener('click', function() {
                                currentIndex = parseInt(this.dataset.index);
                                updateCarousel();
                            });
                        });

                        setInterval(function() {
                            currentIndex = (currentIndex + 1) % slideCount;
                            updateCarousel();
                        }, 8000);
                    });
                </script>
            <?php
            }
            ?>
        </div>
    </div>
</section>