console.log("Script chargé");
document.addEventListener('DOMContentLoaded', function () {
    console.log("DOM entièrement chargé et analysé");
    const backToTopBtn = document.getElementById('backToTopBtn');

    if (!backToTopBtn) {
        console.log("Le bouton Back to Top n'a pas été trouvé sur la page");
        return; // Sortie précoce si le bouton n'existe pas
    }

    window.addEventListener('scroll', () => {
        console.log("Scrolling..."); // Cela devrait apparaître lors du défilement
        if (window.scrollY > 100) {
            backToTopBtn.classList.remove('hidden');
        } else {
            backToTopBtn.classList.add('hidden');
        }
    });

    backToTopBtn.addEventListener('click', function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
});
