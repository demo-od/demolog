<div
  class="rounded-lg bg-white block mb-8 p-4 sm:p-6
         mx-3 sm:mx-0
         border border-default rounded-base shadow-xs">

    <a href="#">
        <img
            class="rounded-base w-full h-40 sm:h-48 object-cover"
            src="https://flowbite.com/docs/images/blog/image-1.jpg"
            alt=""
        />
    </a>

    <a href="#">
        <h5
            class="mt-4 sm:mt-6 mb-2
                   text-lg sm:text-xl lg:text-2xl
                   font-semibold tracking-tight text-heading">
            {{ $post->title }}
        </h5>
    </a>

    <p class="mb-4 sm:mb-6 text-sm sm:text-base text-body">
        {{ Str::words($post->content, 20) }}
    </p>

    <a href="#"
       class="text-white inline-flex items-center
              bg-blue-600 hover:bg-blue-500
              shadow-xs font-medium
              text-xs sm:text-sm
              px-3 py-2 sm:px-4 sm:py-2.5
              rounded-lg focus:outline-none">
        Read more
        <svg class="w-4 h-4 ms-1.5" aria-hidden="true"
             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="2"
                  d="M19 12H5m14 0-4 4m4-4-4-4" />
        </svg>
    </a>
</div>
