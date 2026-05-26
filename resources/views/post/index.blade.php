<x-app-layout>
    <x-toast />
    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-8 px-4 md:px-0 flex items-center justify-between">
                <h1 class="text-xl lg:text-2xl font-bold text-gray-900">
                    @if(request()->routeIs('post.byCategory'))
                        Category: <span class="text-blue-600">{{ request()->route('category')->name }}</span>
                    @else
                        Latest Feed
                    @endif
                </h1>
                <p class="text-sm text-gray-500 font-medium">{{ $posts->total() }} {{ Str::plural('Post', $posts->total()) }}</p>
            </div>

            {{-- The responsive grid system starts here --}}
            @if ($posts->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 px-4 md:px-0">
                    @foreach ($posts as $post)
                        <x-post-item :post="$post" />
                    @endforeach
                </div>
            @else
                <div class="text-center mt-8 p-12 bg-white rounded-xl border border-gray-100 shadow-sm mx-4 md:mx-0">
                    <p class="text-gray-500 text-lg">No posts found in this category.</p>
                    <a href="{{ route('dashboard') }}" class="text-blue-600 font-medium hover:text-blue-700 hover:underline mt-2 inline-block">
                        View all posts
                    </a>
                </div>
            @endif

            <div class="mt-12 px-4 md:px-0">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>