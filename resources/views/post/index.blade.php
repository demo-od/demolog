<x-app-layout>

    <div class="py-4">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">


                <x-category-tabs />
                </div>
            </div>
            <div class="mt-8 text-gray-900 xs:mx-4 md:mx-0">
                @forelse ($posts as $post)
                    <x-post-item :post="$post" />
                    @empty
                    <div class="text-center mt-8">No posts found</div>
                @endforelse
            </div>

            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
