<div class="flex flex-col justify-between rounded-xl bg-white p-4 border border-gray-100 shadow-sm transition-all duration-200 hover:shadow-md hover:-translate-y-0.5 h-full">
    
    <div>
        {{-- Post Image --}}
        @if($post->image)
            <img class="rounded-lg w-full aspect-[16/9] object-cover" src="{{ $post->image }}" alt="Post image" />
        @else
            {{-- Fallback placeholder if post has no image --}}
            <div class="rounded-lg w-full aspect-[16/9] bg-gray-50 flex items-center justify-between justify-center text-gray-400">
                <svg class="w-8 h-8 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 002-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
        @endif

        {{-- Meta Badges (Author & Date) --}}
        <div class="mt-4 mb-2 text-xs text-gray-500 flex items-center gap-2">
            <span class="font-medium text-gray-700">
                by <a href="{{ route('profile.show', $post->user) }}" class="text-blue-600 hover:underline">{{ $post->user->username }}</a>
            </span>
            <span class="text-gray-300">•</span>
            <span>{{ $post->created_at->format('M d, Y') }}</span>
        </div>

        {{-- Post Title --}}
        <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 line-clamp-2" title="{{ $post->title }}">
            {{ $post->title }}
        </h5>

        {{-- Post Excerpt --}}
        <p class="mb-4 text-sm text-gray-600 line-clamp-3">
            {{ Str::words(strip_tags(Illuminate\Support\Str::markdown($post->content)), 18, '...') }}
        </p>
    </div>

    {{-- Actions Row --}}
    <div class="flex items-center justify-between mt-auto pt-2 border-t border-gray-50">
        <a href="{{ route('post.show', ['username' => $post->user->username, 'post' => $post]) }}"
            class="inline-flex items-center justify-between text-sm font-semibold text-blue-600 hover:text-blue-700 group transition-colors">
            Read full post
            <svg class="w-4 h-4 ms-1 transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
            </svg>
        </a>

        @if (auth()->check() && $post->user->id === auth()->user()->id)
            <a href="{{ route('post.edit', $post) }}" class="text-gray-400 hover:text-gray-600 p-1.5 rounded-md hover:bg-gray-50 transition-colors" title="Edit Post">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
            </a>
        @endif
    </div>

</div>