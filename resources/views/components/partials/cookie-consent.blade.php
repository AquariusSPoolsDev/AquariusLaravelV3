{{-- COOKIE CONSENT TOAST — bottom left, Alpine.js --}}
<div
    x-data="{
        show: false,
        init() {
            const consent = this.getCookie('aquarius_cookie_consent');
            if (!consent) this.show = true;
        },
        accept() {
            this.setCookie('aquarius_cookie_consent', 'accepted', 180);
            this.show = false;
            if (typeof aquariusLoadGTM === 'function') aquariusLoadGTM();
            document.dispatchEvent(new Event('cookie-accepted'));
        },
        decline() {
            this.setCookie('aquarius_cookie_consent', 'declined', 180);
            this.show = false;
        },
        getCookie(name) {
            return document.cookie.split(';').map(c => c.trim()).find(c => c.startsWith(name + '='))?.split('=')[1] || null;
        },
        setCookie(name, value, days) {
            const expires = new Date(Date.now() + days * 864e5).toUTCString();
            document.cookie = name + '=' + value + '; expires=' + expires + '; path=/; SameSite=Lax';
        }
    }"
    x-show="show"
    x-cloak
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-4"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-4"
    class="fixed bottom-12 md:bottom-6 left-6 z-50 max-w-sm w-[calc(100vw-2.5rem)] bg-white border border-neutral-200 rounded-xl shadow-xl shadow-neutral-200/60 p-4"
    role="dialog"
    aria-label="Cookie consent"
>
    <p class="text-sm text-neutral-700 mb-3">
        This website uses cookies to enhance your experience within the site.
        <a href="{{ route('privacy-page') }}" class="font-semibold text-neutral-900 underline underline-offset-4 hover:no-underline">Privacy Policy</a>
    </p>
    <div class="flex gap-2">
        <button
            @click="accept"
            class="flex-1 py-2 px-4 text-sm font-semibold rounded-lg bg-primary text-white hover:bg-primary-600 active:bg-primary-700 active:scale-95 transition-all cursor-pointer">
            Accept
        </button>
        <button
            @click="decline"
            class="flex-1 py-2 px-4 text-sm font-semibold rounded-lg bg-neutral-100 text-neutral-700 hover:bg-neutral-200 active:scale-95 transition-all cursor-pointer">
            Decline
        </button>
    </div>
</div>
