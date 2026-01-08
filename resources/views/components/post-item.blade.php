<div
    class="rounded-lg bg-white block mb-8
           p-4 md:p-6
           mx-3 md:mx-0
           border border-default rounded-base shadow-xs">

    <a href="#">
        <img class="rounded-base w-full aspect-[16/9] object-cover"
            src="{{ $post->image }}" alt="Post image" />
    </a>

    <a href="#">
        <h5
            class="mt-4 md:mt-6 mb-2
                   text-lg md:text-2xl
                   font-semibold tracking-tight text-heading">
            {{ $post->title }}
        </h5>
    </a>

    <p class="mb-4 md:mb-6 text-sm md:text-base text-body">
        {{ Str::words($post->content, 20) }}
    </p>

    <a href="#"
        class="text-white inline-flex items-center
              bg-black hover:bg-neutral-900
              shadow-xs font-medium
              text-xs md:text-sm
              px-3 py-2 md:px-4 md:py-2.5
              rounded-lg focus:outline-none">

        Read more

        <svg class="w-4 h-4 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 12H5m14 0-4 4m4-4-4-4" />
        </svg>
    </a>
</div>
