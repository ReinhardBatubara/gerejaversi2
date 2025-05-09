let currentSlide = 0;

const updateCarousel = () => {
    const cards = document.querySelectorAll('.carousel .card');
    const dots = document.querySelectorAll('.dot');
    const carousel = document.getElementById('carousel');

    cards.forEach((card, index) => {
        card.classList.toggle('active', index === currentSlide);
    });

    dots.forEach((dot, index) => {
        dot.classList.toggle('active', index === currentSlide);
    });

    // Lebar 1 kartu + jarak antar kartu (margin: 0 10px = total 20px)
    const cardWidth = cards[0].getBoundingClientRect().width + 20;
    const offset = cardWidth * currentSlide;
    carousel.style.transform = `translateX(-${offset}px)`;
};

const moveSlide = (direction) => {
    const cards = document.querySelectorAll('.carousel .card');
    currentSlide = (currentSlide + direction + cards.length) % cards.length;
    updateCarousel();
};

const goToSlide = (index) => {
    currentSlide = index;
    updateCarousel();
};

window.addEventListener('DOMContentLoaded', () => {
    updateCarousel();
    window.moveSlide = moveSlide;
    window.goToSlide = goToSlide;
});
