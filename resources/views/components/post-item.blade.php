<div
    class="rounded-lg bg-white block mb-8
           p-4 md:p-6
           mx-3 md:mx-0
           border border-default rounded-base shadow-xs">
        <img class="rounded-base w-full aspect-[16/9] object-cover"
            src="{{ $post->image }}" alt="Post image" />
        <h5
            class="mt-4 md:mt-6 mb-2
                   text-lg md:text-2xl
                   font-semibold tracking-tight text-heading">
            {{ $post->title }}
        </h5>

    <p class="mb-4 md:mb-6 text-sm md:text-base text-body">
        {{ Str::words($post->content, 20) }}
    </p>

    <a href="{{ route('post.show',[
    'username' => $post->user->username,
    'post' => $post,
    ]) }}"
        class="inline-flex items-center px-4 py-2 bg-black border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-neutral-900 focus:bg-neutral-900 active:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-neutral-700 focus:ring-offset-2 transition ease-in-out duration-150
              ">

        Read more

        <svg class="w-4 h-4 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 12H5m14 0-4 4m4-4-4-4" />
        </svg>
    </a>
</div>
