<x-app-layout>
    {{-- Add EasyMDE Assets --}}
    <link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
    <script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>

    <style>
        .editor-toolbar { border-color: #e5e7eb; border-radius: 8px 8px 0 0; }
        .CodeMirror { border-color: #e5e7eb; border-radius: 0 0 8px 8px; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; }
        .editor-statusbar { display: none; }
        [x-cloak] { display: none !important; }
    </style>

    <x-toast />
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-sm sm:rounded-lg">
                <h2 class="text-2xl font-bold mb-6">Edit Post: {{ $post->title }}</h2>

                <form action="{{ route('post.update', $post) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Title --}}
                    <div class="mb-4">
                        <x-input-label for="title" value="Title" />
                        <x-text-input id="title" name="title" type="text" class="block mt-1 w-full"
                            :value="old('title', $post->title)" required />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    {{-- Category --}}
                    <div class="mb-4">
                        <x-input-label for="category" value="Category" />
                        <select name="category" id="category"
                            class="w-full border-gray-300 focus:border-neutral-700 focus:ring-neutral-700 rounded-md shadow-sm">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category', $post->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    {{-- Image Preview --}}
                    <div class="mb-4">
                        <x-input-label value="Current Cover Image" />
                        <img src="{{ $post->image }}" class="w-48 h-32 object-cover rounded mt-2 border shadow-sm"
                            alt="Current Image">
                    </div>

                    {{-- Image Upload --}}
                    <div class="mb-4">
                        <x-input-label for="image" value="Replace Cover Image (Optional)" />
                        <input type="file" name="image" id="image"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-neutral-100 file:text-neutral-700 hover:file:bg-neutral-200 cursor-pointer" />
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    {{-- Markdown Content Editor --}}
                    <div class="mb-4" 
                         x-data="{ 
                            init() { 
                                new EasyMDE({ 
                                    element: this.$refs.editor,
                                    forceSync: true,
                                    placeholder: 'Write your content here...',
                                    spellChecker: false,
                                    status: false,
                                    minHeight: '300px'
                                }); 
                            } 
                         }">
                        <x-input-label for="content" value="Content" />
                        <div class="mt-1">
                            <textarea x-ref="editor" name="content" id="content">{{ old('content', $post->content) }}</textarea>
                        </div>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4 mt-6">
                        <x-submitButton class="mb-4">UPDATE POST</x-submitButton>
                        <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:underline">Cancel</a>
                    </div>
                </form> 

                {{-- Danger Zone --}}
                <div class="mt-10 border-t pt-6">
                    <h3 class="text-lg font-bold text-red-600">Danger Zone</h3>
                    <p class="text-sm text-gray-500 mb-4">Once you delete a post, there is no going back.</p>

                    <form action="{{ route('post.destroy', $post) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to permanently delete this post?');">
                        @csrf
                        @method('DELETE')
                        
                        <button type="submit"
                            class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition font-semibold text-sm uppercase tracking-widest shadow-sm">
                            Delete Post
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>