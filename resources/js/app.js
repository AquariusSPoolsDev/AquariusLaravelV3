import './bootstrap';
import 'preline';
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();
import 'fslightbox';

// core version + navigation, pagination modules:
import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';
// import Swiper and modules styles
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

// init Swiper:
const swiper = new Swiper('.swiper', {
    // configure Swiper to use modules
    modules: [Navigation, Pagination],
    loop: true,

    // If we need pagination
    pagination: {
        el: '.swiper-pagination',
    },

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    // And if we need scrollbar
    scrollbar: {
        el: '.swiper-scrollbar',
    },
});

// Get the 'to top' button element by ID
var toTopButton = document.getElementById("to-top-button");

// Check if the button exists
if (toTopButton) {

    // On scroll event, toggle button visibility based on scroll position
    window.onscroll = function() {
        if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) {
            toTopButton.classList.remove("hidden");
        } else {
            toTopButton.classList.add("hidden");
        }
    };

    // Function to scroll to the top of the page smoothly
    window.goToTop = function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    };
}

//
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
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
