/* Beauty Basant — front-end interactivity */
(function () {
  'use strict';

  /* ---------- Hero Slider ---------- */
  function initSlider() {
    var container = document.querySelector('.hero-slider-container');
    if (!container) return;

    var slides = container.querySelectorAll('.slide');
    var dots = container.querySelectorAll('.dot');
    var totalSlides = slides.length;
    if (totalSlides < 2) return;

    var currentSlide = 0;
    var slideInterval;

    function showSlide(index) {
      slides.forEach(function (slide, i) {
        slide.classList.remove('active');
        if (dots[i]) dots[i].classList.remove('active');
      });

      if (index >= totalSlides) currentSlide = 0;
      else if (index < 0) currentSlide = totalSlides - 1;
      else currentSlide = index;

      slides[currentSlide].classList.add('active');
      if (dots[currentSlide]) dots[currentSlide].classList.add('active');
    }

    function nextSlide() { showSlide(currentSlide + 1); }

    function startAutoSlide() {
      slideInterval = setInterval(nextSlide, 4000);
    }

    container.querySelectorAll('.slider-arrow.prev').forEach(function (btn) {
      btn.addEventListener('click', function () {
        clearInterval(slideInterval);
        showSlide(currentSlide - 1);
        startAutoSlide();
      });
    });

    container.querySelectorAll('.slider-arrow.next').forEach(function (btn) {
      btn.addEventListener('click', function () {
        clearInterval(slideInterval);
        showSlide(currentSlide + 1);
        startAutoSlide();
      });
    });

    dots.forEach(function (dot, index) {
      dot.addEventListener('click', function () {
        clearInterval(slideInterval);
        showSlide(index);
        startAutoSlide();
      });
    });

    startAutoSlide();
  }

  /* ---------- Mobile menu toggle ---------- */
  function initMenuToggle() {
    var toggle = document.querySelector('.menu-toggle');
    var nav = document.querySelector('.main-navigation');
    if (!toggle || !nav) return;

    toggle.addEventListener('click', function () {
      nav.classList.toggle('is-open');
      var expanded = toggle.getAttribute('aria-expanded') === 'true';
      toggle.setAttribute('aria-expanded', String(!expanded));
    });
  }

  /* ---------- Newsletter AJAX subscribe ---------- */
  function initNewsletter() {
    var form = document.querySelector('.newsletter-form');
    if (!form || typeof beautyBasant === 'undefined') return;

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var input = form.querySelector('input[type="email"]');
      var msg = form.parentNode.querySelector('.newsletter-message');
      var email = input ? input.value.trim() : '';

      if (!email) return;

      var data = new FormData();
      data.append('action', 'beauty_basant_subscribe');
      data.append('nonce', beautyBasant.nonce);
      data.append('email', email);

      fetch(beautyBasant.ajaxUrl, { method: 'POST', body: data })
        .then(function (res) { return res.json(); })
        .then(function (res) {
          if (!msg) return;
          msg.textContent = res.data && res.data.message ? res.data.message : '';
          msg.className = 'newsletter-message ' + (res.success ? 'success' : 'error');
          if (res.success) input.value = '';
        })
        .catch(function () {
          if (msg) {
            msg.textContent = 'Something went wrong. Please try again.';
            msg.className = 'newsletter-message error';
          }
        });
    });
  }

  document.addEventListener('DOMContentLoaded', function () {
    initSlider();
    initMenuToggle();
    initNewsletter();
  });
})();
