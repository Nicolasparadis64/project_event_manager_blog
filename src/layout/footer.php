</main>
<footer class="bg-white shadow mt-auto">
    <div class="max-w-7xl mx-auto py-4 px-4 text-center text-gray-600">
        <p>&copy; <?= date('Y') ?> EventManager. Tous droits réservés.</p>
    </div>
</footer>


<script>
    let prevScrollpos = window.pageYOffset;
    const navbar = document.getElementById("navbar");

    window.onscroll = function() {
        let currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
            navbar.classList.remove("slide-up");
        } else {
            navbar.classList.add("slide-up");
        }
        prevScrollpos = currentScrollPos;
    }

    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const eventCards = document.querySelectorAll('.event-card');

        eventCards.forEach(card => {
            const title = card.querySelector('h3').textContent.toLowerCase();
            const description = card.querySelector('p').textContent.toLowerCase();

            if (title.includes(searchValue) || description.includes(searchValue)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
</script>
</body>

</html>