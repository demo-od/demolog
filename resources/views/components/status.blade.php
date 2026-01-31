<div class="fixed top-4 end-4 z-50">
    <div class="max-w-xs bg-teal-500 text-sm text-white rounded-xl shadow-lg transition-all duration-300"
        role="alert" tabindex="-1" aria-labelledby="hs-toast-solid-color-teal-label">
        <div class="flex p-4">
            <p id="hs-toast-solid-color-teal-label" class="flex-1">
                {{ $slot }}
            </p>

            <div class="ms-3">
                <button type="button"
                    class="inline-flex shrink-0 justify-center items-center size-5 rounded-lg text-white hover:text-white opacity-50 hover:opacity-100 focus:outline-none focus:opacity-100"
                    onclick="this.closest('.fixed').remove()" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>