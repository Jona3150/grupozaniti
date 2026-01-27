// js/carousel.js
(function(){
    const root = document.querySelector('.carousel.zaniti');
    if(!root) return;

    const viewport = root.querySelector('.carousel-viewport');
    const track = root.querySelector('.carousel-track');
    const slides = Array.from(root.querySelectorAll('.slide'));
    const prevBtn = root.querySelector('.carousel-btn.prev');
    const nextBtn = root.querySelector('.carousel-btn.next');
    const dotsContainer = root.querySelector('.carousel-dots');

    let currentIndex = 0;
    let timer = null;
    const interval = 4000;

    slides.forEach((_, index) => {
      const dot = document.createElement('button');
      dot.className = 'dot';
      dot.setAttribute('aria-label', `Go to slide ${index + 1}`);
      dot.addEventListener('click', () => {
        goToSlide(index);
        stopAutoPlay();
      });
      dotsContainer.appendChild(dot);
    });
    const dots = Array.from(dotsContainer.children);

    function goToSlide(index) {
      const position = -index * 100;
      track.style.transform = `translateX(${position}%)`;
      dots.forEach(d => d.classList.remove('active'));
      dots[index].classList.add('active');
      currentIndex = index;
      adjustHeight();
    }

    function nextSlide() {
      const newIndex = (currentIndex + 1) % slides.length;
      goToSlide(newIndex);
    }
    
    function prevSlide() {
      const newIndex = (currentIndex - 1 + slides.length) % slides.length;
      goToSlide(newIndex);
    }

    function adjustHeight() {
      const activeSlide = slides[currentIndex];
      const img = activeSlide.querySelector('img');
      if (img) {
        if (img.complete) {
          viewport.style.height = `${img.clientHeight}px`;
        } else {
          img.onload = () => { viewport.style.height = `${img.clientHeight}px`; };
        }
      }
    }

    function startAutoPlay() {
      stopAutoPlay();
      timer = setInterval(nextSlide, interval);
    }

    function stopAutoPlay() {
      if (timer) clearInterval(timer);
      timer = null;
    }

    nextBtn.addEventListener('click', () => { nextSlide(); stopAutoPlay(); });
    prevBtn.addEventListener('click', () => { prevSlide(); stopAutoPlay(); });

    root.addEventListener('mouseenter', stopAutoPlay);
    root.addEventListener('mouseleave', startAutoPlay);

    goToSlide(0);
    startAutoPlay();
    window.addEventListener('resize', () => { goToSlide(currentIndex); });
})();

// Lógica del Menú Móvil
(function(){
    const menuToggle = document.querySelector('.menu-toggle');
    const mobileNav = document.querySelector('.mobile-nav');
    if (menuToggle && mobileNav) {
      menuToggle.addEventListener('click', () => {
        mobileNav.classList.toggle('is-open');
        menuToggle.classList.toggle('is-active');
      });
    }
})();