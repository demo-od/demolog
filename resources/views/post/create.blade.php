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
                <form enctype="multipart/form-data" action="{{ route('posts.store') }}" method="post">
                    @csrf
                    {{-- Image --}}
                    <div class="mb-4">
                        <x-input-label for="image" :value="__('Image')" />
                        <input required type="file" class="{{ $file_styles }}" name="image" id="image">
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    {{-- Title --}}
                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <input class="{{ $class }}" id="title" class="block mt-1 w-full" type="text"
                            name="title" value="{{ @old('title') }}" required />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    {{-- Category --}}
                    <div class="mt-4">
                        <x-input-label for="category" :value="__('Category')" />
                        <select id="category" name="category"
                            class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                            <option selected=""disabled>Choose a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category'))>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    {{-- Content --}}
                    <div class="mt-4">
                        <x-input-label for="content" :value="__('Content')" />
                        <x-textarea class="{{ $class }}" required id="content" class="block mt-1 w-full"
                            name="content" required>{{ @old('content') }}</x-textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>

                    <x-submitButton >
                        SUBMIT
                    </x-submitButton>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
