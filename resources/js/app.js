import './bootstrap';
import 'preline';
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();
import 'fslightbox';

// core version + navigation, pagination modules:
import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';
window.Swiper = Swiper;
window.SwiperNavigation = Navigation;
window.SwiperPagination = Pagination;
// import Swiper and modules styles
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

document.addEventListener('DOMContentLoaded', function () {
    // init Swiper only on pages that have a swiper element
    if (document.querySelector('.swiper')) {
        new Swiper('.swiper', {
            modules: [Navigation, Pagination],
            loop: true,
            pagination: { el: '.swiper-pagination' },
            navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
            scrollbar: { el: '.swiper-scrollbar' },
        });
    }

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
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };
});

//
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');

    if (!searchInput) return;

    const tagCheckboxes = document.querySelectorAll('.tag-checkbox');
    const tagSelect = document.getElementById('multiple-with-conditional-counter-select'); // Updated reference
    const imageGrid = document.getElementById('image-grid');
    const paginationContainer = document.getElementById('pagination');
    const resetButton = document.getElementById('reset-button');
    const loadingIndicator = document.getElementById('loading-indicator');
    const noResultsMessage = document.getElementById('no-results-message');

    // Debounce function to limit the rate of function execution
    function debounce(func, delay) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    }

    // Fetch images based on current filters
    function fetchImages(page = 1) {
        // Show loading indicator
        loadingIndicator.style.display = 'block';
        noResultsMessage.style.display = 'none'; // Hide no results message

        // Collect selected tags from checkboxes
        const selectedTagsCheckboxes = Array.from(tagCheckboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.value);

        // Collect selected tags from the select dropdown
        const selectedTagsSelect = Array.from(tagSelect.selectedOptions)
            .map(option => option.value);

        // Combine both selections
        const selectedTags = [...new Set([...selectedTagsCheckboxes, ...selectedTagsSelect])];

        // Prepare request data
        const params = {
            page: page,
            search: searchInput.value,
            tags: selectedTags
        };

        axios.get('/showcase', { 
            params: params,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            imageGrid.innerHTML = response.data.html;
            paginationContainer.innerHTML = response.data.pagination;
            attachPaginationListeners();

            // Hide loading indicator after response
            loadingIndicator.style.display = 'none';

            // Check if there are no images returned
            if (response.data.html.trim() === '') {
                noResultsMessage.style.display = 'block'; // Show no results message
            } else {
                noResultsMessage.style.display = 'none'; // Hide if there are results
            }

            // After updating the grid, refresh the lightbox
            refreshFsLightbox(); // Ensure lightbox is updated with new content
        })
        .catch(error => {
            console.error('Error:', error);
            loadingIndicator.style.display = 'none'; // Hide loading on error
        });
    }

    // Attach pagination listeners
    function attachPaginationListeners() {
        document.querySelectorAll('#pagination a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const url = new URL(this.href);
                const page = url.searchParams.get('page');
                fetchImages(page);
            });
        });
    }

    // Debounced version of fetchImages
    const debouncedFetchImages = debounce(fetchImages, 300); // Adjust delay as needed

    // Add event listeners for search input and tag checkboxes with debounce
    searchInput.addEventListener('input', debouncedFetchImages);
    
    tagCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', debouncedFetchImages);
    });

    // Event listener for the select dropdown in smaller viewports
    if (tagSelect) {
        tagSelect.addEventListener('change', debouncedFetchImages);
    }

    // Reset button functionality
    resetButton.addEventListener('click', function() {
        searchInput.value = ''; // Clear search input
        
        tagCheckboxes.forEach(checkbox => checkbox.checked = false); // Uncheck all checkboxes
        
        if (tagSelect) {
            const selectInstance = HSSelect.getInstance(tagSelect, true); // Get instance of HSSelect
            if (selectInstance) {
                selectInstance.element.setValue([]); // Clear selected values in the select dropdown
            }
        }

        fetchImages(); // Fetch images with default parameters
    });

    attachPaginationListeners();
});

//
