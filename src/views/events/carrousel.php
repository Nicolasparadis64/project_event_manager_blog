<section class="py-16 bg-gray-50">
    <?php
    if (!isset($events) || empty($events)) {
        echo '<div class="w-full text-center py-8"><p class="text-gray-600">Aucun événement à afficher dans le carrousel.</p></div>';
    } else {
        $featuredEvents = array_slice($events, 0, min(5, count($events)));
    ?>

    <div class=" mx-auto px-4">
        <h2 class="text-3xl font-bold mb-10 text-center">Événements à la une</h2>
        
        <div class="carousel-container relative overflow-hidden">
            <div class="carousel-slides flex transition-transform duration-500 ease-out" id="carouselSlides">
                <?php foreach ($featuredEvents as $index => $event): ?>
                    <div class="carousel-slide px-4" data-index="<?= $index ?>" style="min-width: 50%; flex: 0 0 50%;">
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden h-full flex flex-col transform transition-all duration-300">
                            <!-- Image de l'événement -->
                            <?php if (isset($event['image_path']) && !empty($event['image_path'])): ?>
                                <div class="h-56 bg-cover bg-center" style="background-image: url('<?= htmlspecialchars($event['image_path']) ?>')"></div>
                            <?php else: ?>
                                <div class="h-56 bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
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
                                    <a href="?view=view_event&id=<?= $event['id_evenement'] ?>" 
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gray-600 hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300">
                                        Détails
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Navigation buttons -->
            <button id="prevBtn" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white rounded-full p-3 shadow-lg z-10 hover:bg-gray-100 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button id="nextBtn" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white rounded-full p-3 shadow-lg z-10 hover:bg-gray-100 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
    const slides = document.getElementById('carouselSlides');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const slideElements = document.querySelectorAll('.carousel-slide');
    const slideCount = slideElements.length;
    let currentIndex = 0;
    
    // Fonction pour centrer la slide active
    function updateCarousel() {
        // Calculer la position pour centrer la slide active
        const slideWidth = window.innerWidth < 768 ? 100 : 50; // Largeur en pourcentage
        
        // Pour centrer, nous calculons un décalage qui dépend de la largeur de la fenêtre
        // Si slideWidth est 50%, nous voulons décaler de 25% pour centrer la première slide
        const centerOffset = window.innerWidth < 768 ? 0 : 25;
        
        // La transformation inclut maintenant le centrage
        const transformValue = -currentIndex * slideWidth + centerOffset;
        slides.style.transform = `translateX(${transformValue}%)`;
        
        // Mettre à jour l'apparence de chaque slide
        slideElements.forEach((slide, index) => {
            const slideDiv = slide.querySelector('div');
            if (index === currentIndex) {
                // Slide active
                slideDiv.style.opacity = '1';
                slideDiv.style.transform = 'scale(1)';
                slideDiv.classList.add('active-slide');
            } else {
                // Slides inactives
                slideDiv.style.opacity = '0.6';
                slideDiv.style.transform = 'scale(0.9)';
                slideDiv.classList.remove('active-slide');
            }
        });
    }
    
    // Initialiser le carrousel
    updateCarousel();
    
    // Événements des boutons
    prevBtn.addEventListener('click', function() {
        currentIndex = (currentIndex - 1 + slideCount) % slideCount;
        updateCarousel();
    });
    
    nextBtn.addEventListener('click', function() {
        currentIndex = (currentIndex + 1) % slideCount;
        updateCarousel();
    });
    
    // Auto-rotation du carrousel
    let autoRotate = setInterval(function() {
        currentIndex = (currentIndex + 1) % slideCount;
        updateCarousel();
    }, 6000);

    // Arrêter l'auto-rotation quand on survole le carrousel
    const carouselContainer = document.querySelector('.carousel-container');
    carouselContainer.addEventListener('mouseenter', function() {
        clearInterval(autoRotate);
    });
    
    // Reprendre l'auto-rotation quand on quitte le carrousel
    carouselContainer.addEventListener('mouseleave', function() {
        autoRotate = setInterval(function() {
            currentIndex = (currentIndex + 1) % slideCount;
            updateCarousel();
        }, 6000);
    });

    // Adaptation responsive
    function adjustCarousel() {
        const windowWidth = window.innerWidth;
        if (windowWidth < 768) { // Mobile
            slideElements.forEach(slide => {
                slide.style.minWidth = '100%';
                slide.style.flex = '0 0 100%';
            });
        } else {
            slideElements.forEach(slide => {
                slide.style.minWidth = '50%';
                slide.style.flex = '0 0 50%';
            });
        }
        updateCarousel();
    }
    
    // Appeler au chargement et au redimensionnement
    adjustCarousel();
    window.addEventListener('resize', adjustCarousel);
    
    // Ajouter une transition plus fluide
    slides.style.transition = 'transform 0.5s cubic-bezier(0.25, 1, 0.5, 1)';
});
    </script>
    <?php
    }
    ?>
</section>