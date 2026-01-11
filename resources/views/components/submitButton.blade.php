<button
    type="submit"
    data-loading-button
    class="relative inline-flex items-center justify-center h-10 px-6 min-w-[120px]
           bg-black border border-transparent rounded-md font-semibold text-sm text-white
           uppercase tracking-widest hover:bg-neutral-900 focus:ring-2 focus:ring-neutral-700
           transition mt-4">

    <span data-loading-text class="whitespace-nowrap">
        {{ $slot }}
    </span>

    <span data-loading-spinner
        class="hidden absolute inset-0 flex items-center justify-center">
        <span class="animate-spin size-6 border-[2.5px] border-white border-t-transparent rounded-full"></span>
    </span>
</button>
