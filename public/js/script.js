console.log(document.querySelector("link[href='/project_event_manager_blog/public/css/style.css']"));
console.log(document.querySelector("script[src='/project_event_manager_blog/public/js/script.js']"));


document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.getElementById('navbar');
    let lastScrollY = window.scrollY;
    let ticking = false;

    function updateNavbar() {
        const currentScrollY = window.scrollY;

        // Détermine la direction du scroll
        if (currentScrollY > lastScrollY) {
            // Scroll vers le bas
            navbar.classList.add('hidden');
        } else {
            // Scroll vers le haut
            navbar.classList.remove('hidden');
        }

        lastScrollY = currentScrollY;
        ticking = false;
    }

    window.addEventListener('scroll', function() {
        if (!ticking) {
            window.requestAnimationFrame(function() {
                updateNavbar();
            });
            ticking = true;
        }
    });
});


    function adjustCarouselSpacing() {
        const carousel = document.querySelector('.carousel-container'); 
        if (carousel) {
            if (window.innerWidth < 640) { // Mobile
                carousel.classList.remove('px-8', 'px-12');
                carousel.classList.add('max-w-screen-xl mx-auto');
            } else if (window.innerWidth < 1024) { // Tablet
                carousel.classList.remove('px-4', 'px-12');
                carousel.classList.add('max-w-screen-xl mx-auto');
            } else { // Desktop
                carousel.classList.remove('px-4', 'px-8');
                carousel.classList.add('max-w-screen-xl mx-auto');
            }
        }
    }

    window.addEventListener('load', adjustCarouselSpacing);
    window.addEventListener('resize', adjustCarouselSpacing);


    function filterProjects() {
        let input = document.getElementById("search-project").value.toLowerCase();
        let events = document.querySelectorAll(".bg-white.overflow-hidden.shadow.rounded-lg");

        events.forEach(event => {
            let title = event.querySelector("h3").textContent.toLowerCase();
            if (title.includes(input)) {
                event.style.display = "";
            } else {
                event.style.display = "none";
            }
        });
    }

    var typed = new Typed("#typed", {
        strings: ["événement", "spectacle", "conférence", "salon"],
        typeSpeed: 80,
        backSpeed: 50,
        backDelay: 3000,
        startDelay: 500,
        loop: true
    });

    function handleSections() {
        const sections = document.querySelectorAll('section');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                } else {
                    entry.target.style.opacity = '0.5';
                }
            });
        }, {
            threshold: 0.3 // Ajustez cette valeur selon vos besoins
        });
    
        sections.forEach(section => {
            observer.observe(section);
        });
    }
    
    document.addEventListener('DOMContentLoaded', handleSections);