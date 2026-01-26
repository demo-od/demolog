<div
    class="rounded-lg bg-white block mb-8
           p-4 md:p-6
           mx-3 md:mx-0
           border border-default rounded-base shadow-xs">
    <img class="rounded-base w-full aspect-[16/9] object-cover" src="{{ $post->image }}" alt="Post image" />
    <h5
        class="mt-4 md:mt-6 mb-2
                   text-lg md:text-2xl
                   font-semibold tracking-tight text-heading">
        {{ $post->title }}
    </h5>

    <p class="mb-2 md:mb-2 text-sm md:text-base text-body">
        {{ Str::words($post->content, 20) }}
    </p>

    <div class="mb-2 text-gray-500 flex gap-4">
        <span class="text-sm">
            by <a href="{{ route('profile.show', $post->user) }}"
                class="text-blue-600 hover:text-blue-700">{{ $post->user->username }} </a>on
            {{ $post->created_at->format('M d, Y') }}
        </span>


    </div>

    <div class="flex justify-between">
        <a href="{{ route('post.show', [
            'username' => $post->user->username,
            'post' => $post,
        ]) }}"
            class="inline-flex items-center px-4 py-2 bg-black border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-neutral-900 focus:bg-neutral-900 active:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-neutral-700 focus:ring-offset-2 transition ease-in-out duration-150
              ">

            Read full post

            <svg class="w-4 h-4 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 12H5m14 0-4 4m4-4-4-4" />
            </svg>
        </a>
        @if ($post->user->id === auth()->user()->id)
            <a href="{{ route('post.edit', $post) }}" title="Edit Post"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
            </a>
        @endif
    </div>

</div>
