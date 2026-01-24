<button {{ $attributes->merge(['class' => 'relative inline-flex items-center justify-center h-10 px-6
           bg-black border border-transparent rounded-md font-semibold text-sm text-white
           uppercase tracking-widest hover:bg-neutral-900 focus:ring-2 focus:ring-neutral-700
           transition mt-4']) }}
    type="submit"
    data-loading-button>

    <span class="grid grid-cols-1 grid-rows-1 items-center justify-items-center">
        
        <span data-loading-text class="col-start-1 row-start-1 whitespace-nowrap">
            {{ $slot }}
        </span>

        <span data-loading-spinner
            class="hidden col-start-1 row-start-1">
            <span class="animate-spin size-5 border-[2.5px] border-white border-t-transparent rounded-full block"></span>
        </span>
        
    </span>
</button>