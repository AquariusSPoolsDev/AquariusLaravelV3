import './scroll-effects';
import './bootstrap';
import 'preline';
import Alpine from 'alpinejs';
import contactForm from './contact-form';
window.Alpine = Alpine;
Alpine.data('contactForm', contactForm);
Alpine.start();
import 'fslightbox';

import { ajaxPagination } from './ajax-pagination';

// core version + navigation, pagination modules:
import Swiper from 'swiper';
import { A11y, Navigation, Pagination } from 'swiper/modules';
// import Swiper and modules styles
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

document.addEventListener('DOMContentLoaded', function () {
    // Default one-slide carousel (homepage mobile hero). Promotion sliders get their own settings
    // (1/2/3 per view) in initPromoSwipers below; initialising them here too would override that.
    document.querySelectorAll('.swiper:not(.promo-swiper)').forEach(function (el) {
        // A11y: slide labels ("2 / 5"), named arrow buttons and a polite live region, in the page language
        var a11yText = JSON.parse(document.getElementById('swiper-a11y-messages')?.textContent || '{}');
        new Swiper(el, {
            modules: [A11y, Navigation, Pagination],
            loop: true,
            a11y: Object.assign({ enabled: true }, a11yText),
            pagination: { el: el.querySelector('.swiper-pagination') },
            navigation: { nextEl: el.querySelector('.swiper-button-next'), prevEl: el.querySelector('.swiper-button-prev') },
        });
    });

    // Back-to-top + scroll progress bar
    var toTopButton = document.getElementById("to-top-button");
    var progressBar = document.getElementById("scroll-progress-bar");

    window.onscroll = function () {
        var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
        var docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;

        if (progressBar && docHeight > 0) {
            progressBar.style.transform = 'scaleX(' + (scrollTop / docHeight) + ')';
        }

        if (toTopButton) {
            if (scrollTop > 500) {
                toTopButton.classList.remove("opacity-0", "pointer-events-none", "translate-y-4");
                toTopButton.classList.add("opacity-100", "pointer-events-auto", "translate-y-0");
            } else {
                toTopButton.classList.remove("opacity-100", "pointer-events-auto", "translate-y-0");
                toTopButton.classList.add("opacity-0", "pointer-events-none", "translate-y-4");
            }
        }
    };

    window.goToTop = function () {
        var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        window.scrollTo({ top: 0, behavior: reduceMotion ? 'auto' : 'smooth' });
    };
});

// Lists that page through with AJAX: reviews, promotions and the showcase gallery (resources/js/ajax-pagination.js)
document.addEventListener('DOMContentLoaded', function () {
    const reviewsGrid = document.getElementById('reviews-grid');
    if (reviewsGrid) {
        ajaxPagination({
            list: reviewsGrid,
            pagination: document.getElementById('reviews-pagination'),
            loading: document.getElementById('reviews-loading'),
            updateUrl: true,
            scrollToList: true,
        });
    }

    const promosList = document.getElementById('promos-list');
    if (promosList) {
        initPromoSwipers(promosList);
        ajaxPagination({
            list: promosList,
            pagination: document.getElementById('promos-pagination'),
            loading: document.getElementById('promos-loading'),
            updateUrl: true,
            scrollToList: true,
            onLoaded: () => initPromoSwipers(promosList),
        });
    }

    const searchInput = document.getElementById('search-input');
    if (searchInput) {
        initShowcaseGallery(searchInput);
    }
});

/** Promotion sliders: 1 per view on phones, 2 on tablets, 3 on desktops. */
function initPromoSwipers(root) {
    const a11yText = JSON.parse(document.getElementById('swiper-a11y-messages')?.textContent || '{}');
    root.querySelectorAll('.promo-swiper').forEach(function (el) {
        if (el.swiper) {
            el.swiper.destroy(true, true);
        }
        new Swiper(el, {
            modules: [A11y, Navigation, Pagination],
            a11y: Object.assign({ enabled: true }, a11yText),
            loop: false,
            watchOverflow: true,
            slidesPerView: 1,
            spaceBetween: 16,
            breakpoints: {
                768: { slidesPerView: 2, spaceBetween: 16 },
                1024: { slidesPerView: 3, spaceBetween: 24 },
            },
            pagination: { el: el.querySelector('.swiper-pagination'), clickable: true },
            navigation: { nextEl: el.querySelector('.swiper-button-next'), prevEl: el.querySelector('.swiper-button-prev') },
        });
    });
    if (typeof window.refreshFsLightbox === 'function') {
        window.refreshFsLightbox();
    }
}

/** Showcase: search box and tag filters reload the grid as you type or tick; pagination keeps the filters. */
function initShowcaseGallery(searchInput) {
    const tagCheckboxes = document.querySelectorAll('.tag-checkbox');
    const tagSelect = document.getElementById('multiple-with-conditional-counter-select');
    const noResultsMessage = document.getElementById('no-results-message');

    const selectedTags = () => [...new Set([
        ...Array.from(tagCheckboxes).filter((checkbox) => checkbox.checked).map((checkbox) => checkbox.value),
        ...(tagSelect ? Array.from(tagSelect.selectedOptions).map((option) => option.value) : []),
    ])];

    const gallery = ajaxPagination({
        list: document.getElementById('image-grid'),
        pagination: document.getElementById('pagination'),
        loading: document.getElementById('loading-indicator'),
        params: () => ({ search: searchInput.value, tags: selectedTags() }),
        onLoaded: (data) => {
            noResultsMessage.hidden = data.html.trim() !== '';
            window.refreshFsLightbox?.();
        },
    });

    let debounceTimer;
    const reloadFromFirstPage = () => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => gallery.load(1), 300);
    };

    searchInput.addEventListener('input', reloadFromFirstPage);
    tagCheckboxes.forEach((checkbox) => checkbox.addEventListener('change', reloadFromFirstPage));
    tagSelect?.addEventListener('change', reloadFromFirstPage);

    document.getElementById('reset-button').addEventListener('click', function () {
        searchInput.value = '';
        tagCheckboxes.forEach((checkbox) => { checkbox.checked = false; });
        if (tagSelect) {
            window.HSSelect?.getInstance(tagSelect, true)?.element.setValue([]);
        }
        gallery.load(1);
    });
}
