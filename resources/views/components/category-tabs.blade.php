<ul class="flex flex-wrap justify-center gap-1 sm:gap-2
           text-[10px] sm:text-sm font-medium text-center text-body">

    {{-- All --}}
    <li>
        <a href="/"
           class="inline-block px-2 py-1 sm:px-4 sm:py-2 rounded-lg
                  {{ request()->routeIs('dashboard')
                        ? 'bg-blue-600 text-white'
                        : 'hover:text-heading hover:bg-neutral-secondary-soft' }}">
            All
        </a>
    </li>

    {{-- Categories --}}
    @foreach ($categories as $category)
        <li>
            <a href="{{ route('post.byCategory', $category) }}"
               class="inline-block px-2 py-1 sm:px-4 sm:py-2 rounded-lg
                      {{
                          request()->routeIs('post.byCategory') &&
                          request()->route('category')->id === $category->id
                              ? 'bg-blue-600 text-white'
                              : 'hover:text-heading hover:bg-neutral-secondary-soft'
                      }}">
                {{ $category->name }}
            </a>
        </li>
    @endforeach
</ul>
