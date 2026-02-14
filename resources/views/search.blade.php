<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
    <script src="https://kit.fontawesome.com/9c4181398c.js" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }

        /* Hide scrollbar for cleaner results list */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="font-sans antialiased text-gray-900 bg-gray-100">
    <div class="min-h-screen">
        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

                <div x-data="{
                    search: '',
                    users: [],
                    loading: false,
                    fetchUsers() {
                        if (this.search.length < 2) {
                            this.users = [];
                            return;
                        }
                        this.loading = true;
                        fetch(`/api/users/search?q=${encodeURIComponent(this.search)}`)
                            .then(res => res.json())
                            .then(data => {
                                this.users = data;
                                this.loading = false;
                            })
                            .catch(err => {
                                console.error('Search failed:', err);
                                this.loading = false;
                            });
                    },
                    clearSearch() {
                        this.search = '';
                        this.users = [];
                    }
                }" class="p-6 bg-white shadow-sm sm:p-10 sm:rounded-lg">

                    <div class="flex items-center mb-8">
                        <a href="{{ route('dashboard') }}"
                            class="text-gray-400 hover:text-black transition-colors mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                            </svg>
                        </a>
                        <h2 class="text-2xl font-extrabold tracking-tight">Search Users</h2>
                    </div>

                    <div class="relative group">
                        <div class="absolute left-4 top-3.5 text-gray-400">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>

                        <input type="text" x-model="search" @input.debounce.300ms="fetchUsers()"
                            placeholder="Search by  username, or full name..."
                            class="w-full pl-11 pr-12 rounded-xl border-gray-200 focus:border-black focus:ring-black py-3.5 px-4 transition-all shadow-sm">

                        <div x-show="loading" x-cloak class="absolute right-4 top-3.5">
                            <i class="fa-solid fa-spinner animate-spin text-gray-400"></i>
                        </div>

                        <button x-show="search.length > 0 && !loading" x-cloak @click="clearSearch()"
                            class="absolute right-4 top-3.5 text-gray-400 hover:text-gray-600 transition">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </button>
                    </div>

                    <div class="mt-6 space-y-2" x-show="users.length > 0" x-cloak>
                        <template x-for="user in users" :key="user.id">
                            <a :href="'/@' + user.username"
                                class="flex items-center justify-between p-4 hover:bg-gray-50 rounded-2xl transition border border-transparent hover:border-gray-100 group">

                                <div class="flex items-center gap-4">
                                    <template x-if="user.image">
                                        <img :src="user.image"
                                            class="w-12 h-12 rounded-full object-cover border border-gray-100 shadow-sm">
                                    </template>

                                    <template x-if="!user.image">
                                        <div
                                            class="w-12 h-12 rounded-full bg-black flex items-center justify-center text-white text-xl font-bold shrink-0 shadow-sm">
                                            <span
                                                x-text="(user.first_name ? user.first_name.charAt(0) : user.name.charAt(0)).toUpperCase()"></span>
                                        </div>
                                    </template>

                                    <div>
                                        <div class="font-bold text-gray-900"
                                            x-text="user.first_name ? (user.first_name + ' ' + user.last_name) : user.name">
                                        </div>
                                        <div class="text-sm text-gray-500 font-medium" x-text="'@' + user.username">
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="text-gray-300 group-hover:text-black group-hover:translate-x-1 transition-all">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </div>
                            </a>
                        </template>
                    </div>

                    <div class="mt-12 text-center py-8" x-show="search.length >= 2 && users.length === 0 && !loading"
                        x-cloak>
                        <div class="text-gray-300 mb-3">
                            <i class="fa-solid fa-user-slash text-4xl"></i>
                        </div>
                        <p class="text-gray-500">No users found matching "<span class="font-bold text-gray-700"
                                x-text="search"></span>"</p>
                        <p class="text-sm text-gray-400 mt-1">Try checking for typos or searching by username.</p>
                    </div>

                    <div class="mt-12 text-center py-8" x-show="search.length < 2 && !loading">
                        <div class="text-gray-200 mb-3">
                            <i class="fa-solid fa-users text-4xl"></i>
                        </div>
                        <p class="text-gray-400 font-medium">Find someone on the platform</p>
                        <p class="text-xs text-gray-300 mt-1 uppercase tracking-widest">Type at least 2 characters</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
