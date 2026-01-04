<ul class="flex  text-sm font-medium text-center text-body justify-center">
    <li>
        <a href="#" class="inline-block px-4 py-2 text-white bg-blue-600 rounded-lg rounded-base active"
            aria-current="page">All</a>
    </li>
    @foreach ($categories as $category)
        <li>
            <a href="#"
                class="inline-block px-4 py-2 rounded-base hover:text-heading hover:bg-neutral-secondary-soft">
                {{ $category->name }}
            </a>
        </li>
    @endforeach

</ul>
