<button id="to-top-button" onclick="goToTop()" title="Go To Top"
    class="cursor-pointer fixed z-50 bottom-14 lg:bottom-16 right-8 lg:right-12 p-4 border-0 w-14 h-14 rounded-full shadow-lg bg-primary hover:bg-primary-700 active:bg-primary-800 active:scale-95 active:shadow-md text-white transition-all duration-300 opacity-0 pointer-events-none translate-y-4 group">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 group-hover:-translate-y-0.5 transition-transform duration-200">
        <path fill-rule="evenodd" d="M11.47 7.72a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 1 1-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 0 1-1.06-1.06l7.5-7.5Z" clip-rule="evenodd" />
    </svg>
    <span class="sr-only">{{__('strings.back_to_top_text')}}</span>
</button>
