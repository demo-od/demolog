@php
    $fcount = $user->followers->count();
@endphp

<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex flex-col gap-8">

                    <x-FollowCtr :user="$user" class="flex flex-col items-center text-center pb-8 border-b">
                        @if ($user->image)
                            <img src="{{ $user->image }}" alt="" class="w-24 h-24">
                        @else
                            <x-default-image class="w-24 h-24" />
                        @endif
                        <h1 class="text-3xl font-bold mt-4">{{ $user->name }}</h1>
                        <p class="text-gray-500">
                            <span x-text="followersCount"></span> 
                            <span x-text="followersCount==1 ? 'follower' : 'followers'"></span>
                        </p>
                        <p class="text-gray-500 max-w-lg mt-2">
                            {{ $user->bio }}
                        </p>
                        <div>
                            @if (auth()->user()->id !== $user->id)
                                <button @click="follow()" class="rounded-full px-6 py-2 mt-4 font-semibold transition"
                                    :class="following
                                        ?
                                        'bg-neutral-200 text-black hover:bg-neutral-300' :
                                        'bg-blue-600 text-white hover:bg-blue-500'"
                                    x-text="following ? 'Following' : 'Follow'">
                                </button>
                            @endif

                        </div>
                    </x-FollowCtr>

                    <div class="w-full">
                        <h2 class="text-xl font-semibold mb-4 pl-4">Latest Posts</h2>
                        <div class="space-y-4">
                            @forelse ($posts as $post)
                                <x-post-item :post="$post" />
                            @empty
                                <div class="text-center mt-8 text-gray-400">No posts found</div>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
