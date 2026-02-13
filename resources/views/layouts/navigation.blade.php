<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}"
                        class="text-white bg-black flex items-center justify-center rounded-md w-10 h-10 p-2 shadow-lg hover:bg-gray-800 transition">
                        <span class="text-lg font-bold tracking-tighter">DL</span>
                    </a>
                </div>
            </div>

            <div class="flex items-center space-x-2">
                <div class="hidden sm:flex items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-4 py-2 border border-gray-200 text-sm font-semibold rounded-full text-gray-700 bg-gray-50 hover:bg-gray-100 hover:border-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 me-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                                    </svg>
                                    @if(request()->routeIs('post.byCategory'))
                                        <span class="text-blue-600">{{ request()->route('category')->name }}</span>
                                    @else
                                        Categories
                                    @endif
                                </span>
                                <svg class="ms-2 h-4 w-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                {{ __('All Posts') }}
                            </x-dropdown-link>
                            <div class="border-t border-gray-100"></div>
                            @foreach ($categories as $category)
                                <x-dropdown-link :href="route('post.byCategory', $category)" :active="request()->routeIs('post.byCategory') && request()->route('category')->id === $category->id">
                                    {{ $category->name }}
                                </x-dropdown-link>
                            @endforeach
                        </x-slot>
                    </x-dropdown>
                </div>

                <a href="{{ route('search') }}" class="text-gray-400 hover:text-gray-600 p-2 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </a>

                <div class="hidden sm:block">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="p-2 text-gray-400 hover:text-gray-600 focus:outline-none transition">
                                <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.show', auth()->user())">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('post.create')">
                                {{ __('Create Post') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Settings') }}
                            </x-dropdown-link>
                            <div class="border-t border-gray-100"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <div class="sm:hidden flex items-center">
                    <button @click="open = ! open" class="p-2 rounded-md text-gray-400 hover:text-gray-500 focus:outline-none transition">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="sm:hidden border-t border-gray-100 bg-gray-50/50">
        <div class="flex overflow-x-auto no-scrollbar py-3 px-4 space-x-3 whitespace-nowrap">
            <a href="{{ route('dashboard') }}" 
               class="text-xs font-bold px-3 py-1.5 rounded-full {{ request()->routeIs('dashboard') ? 'bg-black text-white' : 'bg-white border border-gray-200 text-gray-600' }}">
                All
            </a>
            @foreach ($categories as $category)
                <a href="{{ route('post.byCategory', $category) }}" 
                   class="text-xs font-bold px-3 py-1.5 rounded-full {{ (request()->routeIs('post.byCategory') && request()->route('category')->id === $category->id) ? 'bg-black text-white' : 'bg-white border border-gray-200 text-gray-600' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-gray-100">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('profile.show', auth()->user())">
                {{ __('Profile') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('post.create')">
                {{ __('Create Post') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profile.edit')">
                {{ __('Settings') }}
            </x-responsive-nav-link>
            <div class="border-t border-gray-200 my-1"></div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</nav>

<style>
    /* Hide scrollbar for cleaner look on mobile scroller */
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>