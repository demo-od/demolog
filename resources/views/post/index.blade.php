<x-app-layout>
    <x-toast />
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-8 px-4 md:px-0 flex items-center justify-between">
                <h1 class="sm:text-lg lg:text-2xl font-bold text-gray-900">
                    @if(request()->routeIs('post.byCategory'))
                        Category: <span class="text-blue-600">{{ request()->route('category')->name }}</span>
                    @else
                        Latest Feed
                    @endif
                </h1>
                <p class="text-sm text-gray-500">{{ $posts->total() }} Posts</p>
            </div>

            <div class="text-gray-900 xs:mx-4 md:mx-0">
                @forelse ($posts as $post)
                    <x-post-item :post="$post" />
                @empty
                    <div class="text-center mt-8 p-12 bg-white rounded-lg shadow-sm">
                        <p class="text-gray-500">No posts found in this category.</p>
                        <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline mt-2 inline-block">View all posts</a>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>