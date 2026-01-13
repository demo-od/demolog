<x-app-layout>
    @php
        $class = "w-full border-gray-300 focus:border-neutral-700 focus:ring-neutral-700 rounded-md shadow-sm'])";

        $file_styles = "block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
    file:bg-gray-50 file:border-0
    file:me-4
    file:py-3 file:px-4";
    @endphp
    <div class="py-4">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-8">
                <h1 class="text-4xl font-bold mb-4">{{ $post->title }}</h1>
                {{-- User Avatar --}}
                <div class="flex gap-4">
                    @if ($post->user->image)
                        <div class="circle-container">
                            <img src="{{ $post->user->image }}" class="w-12 h-12" />
                        </div>
                    @else
                        <x-default-image class="w-12 h-12 -mr-2" />
                    @endif
                    {{-- User Avatar End --}}

                </div>
                <div>

                    <div class="flex gap-2">
                        <h3>{{ $post->user->name }}</h3>
                        &middot;
                        <a href="#" class="text-emerald-500">Follow</a>
                    </div>
                    <div class="flex gap-2">
                        <span class="text-gray-500 text-sm">{{ $post->readTime() }} min read
                            &middot;
                            {{ $post->created_at->format('M d, Y') }}
                        </span>

                    </div>
                </div>


                {{-- Clap Section --}}

                {{-- Clap Section End --}}
                    <x-clap-button />
                {{-- Content Section --}}
                <div class="mt-8">
                    <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-full">

                    <div class="mt-4">
                        {{ $post->content }}
                    </div>
                </div>
                {{-- content section end  --}}

                <div class="mt-8">
                    <span class="bg-gray-200 rounded-2xl py-2 px-4 ">{{ 
                        $post->category->name }}</span>
                </div>

                <x-clap-button />
            </div>

        </div>
    </div>
</x-app-layout>
