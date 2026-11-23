/**
 * Loads another page of a list (reviews, promotions, gallery) without reloading the whole page.
 *
 * The controller answers an AJAX request with { html, pagination } (see Controller::paginatedPartial).
 * Clicks on any pagination link inside `pagination` are handled here; a failed request falls back to
 * opening the link normally, so the visitor is never stuck on a half-loaded list.
 *
 * @param {object} options
 * @param {HTMLElement} options.list        Element whose HTML is replaced with the new page.
 * @param {HTMLElement} options.pagination  Element holding the pagination links.
 * @param {HTMLElement} [options.loading]   Shown (hidden attribute removed) while loading.
 * @param {() => object} [options.params]   Extra query values, e.g. search and tags.
 * @param {boolean} [options.updateUrl]     Put ?page=N in the address bar, so reload and share keep the page.
 * @param {boolean} [options.scrollToList]  Scroll back to the top of the list after loading.
 * @param {(data: {html: string}) => void} [options.onLoaded]  Re-run sliders, lightbox, empty state, etc.
 * @returns {{ load: (page?: number|string, fallbackUrl?: string) => Promise<void> }}
 */
export function ajaxPagination({ list, pagination, loading, params = () => ({}), updateUrl = false, scrollToList = false, onLoaded = () => {} }) {
    const reduceMotion = () => window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    const setBusy = (busy) => {
        list.classList.toggle('opacity-0', busy);
        list.classList.toggle('pointer-events-none', busy);
        list.setAttribute('aria-busy', busy ? 'true' : 'false');
        if (loading) {
            loading.hidden = !busy;
        }
    };

    const load = (page = 1, fallbackUrl = null) => {
        setBusy(true);

        return window.axios.get(window.location.pathname, {
            params: { ...params(), page },
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
        }).then((response) => {
            list.innerHTML = response.data.html;
            pagination.innerHTML = response.data.pagination;

            if (updateUrl) {
                const url = new URL(window.location.href);
                if (Number(page) > 1) {
                    url.searchParams.set('page', page);
                } else {
                    url.searchParams.delete('page');
                }
                window.history.replaceState(null, '', url);
            }

            if (scrollToList) {
                const top = list.getBoundingClientRect().top + window.scrollY - 100;
                window.scrollTo({ top, behavior: reduceMotion() ? 'auto' : 'smooth' });
            }

            onLoaded(response.data);
        }).catch((error) => {
            console.error('Could not load the next page:', error);
            if (fallbackUrl) {
                window.location.href = fallbackUrl;
            }
        }).finally(() => setBusy(false));
    };

    // One listener on the container keeps working after the links are replaced
    pagination.addEventListener('click', (event) => {
        const link = event.target.closest('a[href]');
        if (!link || event.metaKey || event.ctrlKey || event.shiftKey || event.button !== 0) {
            return;
        }
        event.preventDefault();
        load(new URL(link.href).searchParams.get('page') || 1, link.href);
    });

    return { load };
}
