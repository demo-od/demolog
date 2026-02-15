<x-app-layout>
    <x-toast />

    @php
        $class = 'w-full border-gray-300 focus:border-neutral-700 focus:ring-neutral-700 rounded-md shadow-sm';

        $file_styles = "block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
            file:bg-gray-50 file:border-0
            file:me-4
            file:py-3 file:px-4";
    @endphp

    <div class="py-4">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-8">
                <h1 class="text-4xl font-bold mb-4">{{ $post->title }}</h1>

                {{-- User Avatar Section --}}
                <div class="flex gap-4">
                    @if ($post->user->image)
                        <img src="{{ $post->user->image }}" alt="" class="w-12 h-12 rounded-full object-cover">
                    @else
                        <x-default-image class="w-12 h-12" :name="$post->user->name" />
                    @endif

                    <div>
                        <x-FollowCtr :user="$post->user" class="flex gap-2 ">
                            <a href="{{ route('profile.show', $post->user) }}" class="hover:underline font-semibold">
                                {{ $post->user->name }}
                            </a>
                            @if (auth()->check() && auth()->id() != $post->user->id)
                                &middot;
                                <button type="button" x-text="following ? 'Unfollow' : 'Follow'"
                                    :class="following ? 'text-red-600' : 'text-emerald-500'" @click="follow()">
                                </button>
                            @endif
                        </x-FollowCtr>

                        <div class="flex gap-2">
                            <span class="text-gray-500 text-sm">
                                {{ $post->readTime() }} min read &middot; {{ $post->created_at->format('M d, Y') }}
                            </span>
                        </div>
                    </div>
                </div>

                <x-clap-button :post="$post" />

                {{-- Content Section --}}
                <div class="mt-8">
                    <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-full rounded-lg shadow-sm">
                    <div class="mt-4 text-lg leading-relaxed text-gray-800 prose border-t-2">
                        {!! Illuminate\Support\Str::markdown($post->content) !!}
                    </div>
                </div>

                <div class="mt-8">
                    <span class="bg-gray-200 rounded-2xl py-2 px-4 text-sm">{{ $post->category->name }}</span>
                </div>

                <hr class="my-8">

                {{-- Leave a Comment Form --}}
                <form action="{{ route('post.comment', $post) }}" method="POST">
                    @csrf
                    <div class="flex items-center justify-center gap-2">
                        <input type="text" name="content" id="content" value="{{ old('content') }}"
                            placeholder="Leave a comment"
                            class="w-full rounded-md @error('content') ring-2 ring-red-500 @else border-gray-300 focus:border-neutral-700 focus:ring-neutral-700 @enderror">

                        <x-submitButton class="max-w-10 max-h-10 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
                            </svg>

                        </x-submitButton>
                    </div>
                    @error('content')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </form>

                {{-- Comments List Section --}}
                <div class="mt-2space-y-4">
                    <h3 class="font-bold text-xl mb-4">Comments</h3>
                    @forelse ($post->comments as $comment)
                        <div class="border-t pt-4 flex flex-col">
                            <div class="flex items-center gap-2 mb-2">
                                @if ($comment->user->image)
                                    <img src="{{ $comment->user->image }}" class="w-6 h-6 rounded-full" alt="">
                                @else
                                    <x-default-image class="w-6 h-6" :name="$comment->user->name" fontSize="xs" />
                                @endif
                                <span class="text-gray-700 font-medium text-sm">{{ $comment->user->username }}</span>
                                <span class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>

                            <div class="text-gray-800">
                                {{ $comment->content }}
                            </div>

                            {{-- Delete Comment Button (Only for owner) --}}
                            @if (auth()->check() && $comment->user->id === auth()->id())
                                <div class="mt-2">
                                    <form action="{{ route('comment.delete', $comment) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 text-xs hover:underline flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-3">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                            Delete comment
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="text-gray-500 italic">No comments yet. Be the first to share your thoughts!</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
