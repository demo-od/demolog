<ul
  class="flex flex-wrap justify-center gap-1 sm:gap-2
         text-[10px] sm:text-sm font-medium text-center text-body">
    
    <li>
        <a href="#"
           class="inline-block px-2 py-1 sm:px-4 sm:py-2
                  text-white bg-blue-600 rounded-lg">
            All
        </a>
    </li>

    @foreach ($categories as $category)
        <li>
            <a href="#"
               class="inline-block px-2 py-1 sm:px-4 sm:py-2
                      rounded-lg hover:text-heading hover:bg-neutral-secondary-soft">
                {{ $category->name }}
            </a>
        </li>
    @endforeach
</ul>
