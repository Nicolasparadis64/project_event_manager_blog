// Suppression des logs de débogage
// console.log(document.querySelector("link[href='/project_event_manager_blog/public/css/style.css']"));
// console.log(document.querySelector("script[src='/project_event_manager_blog/public/js/script.js']"));


document.addEventListener('DOMContentLoaded', function() {
    // Navigation bar hide/show on scroll
    const navbar = document.getElementById('navbar');
    let lastScrollY = window.scrollY;
    let ticking = false;

    function updateNavbar() {
        const currentScrollY = window.scrollY;

        if (currentScrollY > lastScrollY) {
            navbar.classList.add('hidden');
        } else {
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

    // Menu hamburger pour mobile
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            // Toggle la classe hidden sur le menu mobile
            mobileMenu.classList.toggle('hidden');
            console.log('Menu mobile toggled');
        });
    }
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
                entry.target.style.opacity = '1.5';
            } else {
                entry.target.style.opacity = '0.5';
            }
        });
    }, {
        threshold: 0.3
    });

    sections.forEach(section => {
        observer.observe(section);
    });
}

document.addEventListener('DOMContentLoaded', handleSections);