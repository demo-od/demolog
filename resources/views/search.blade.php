<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
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
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
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
                        fetch(`/api/users/search?q=${this.search}`)
                            .then(res => res.json())
                            .then(data => {
                                this.users = data;
                                this.loading = false;
                            })
                            .catch(err => {
                                console.error('Search failed:', err);
                                this.loading = false;
                            });
                    }
                }" class="bg-white shadow-sm sm:rounded-lg p-10">
                    <div class="flex -mb-3">
                        <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-700 mr-4 text-[20px] mt-0.5"><i class="fa-solid fa-arrow-left"></i></a>
                        <h2 class="text-2xl font-bold mb-6">Search for other users</h2>
                    </div>
                    <div class="relative">
                        <input type="text" x-model="search" @input.debounce.300ms="fetchUsers()"
                            placeholder="Type a name or username..."
                            class="w-full rounded-lg border-gray-200 focus:border-black focus:ring-black py-3 px-4">

                        <div x-show="loading" x-cloak class="absolute right-4 top-3.5">
                            <i class="fa-solid fa-spinner animate-spin text-gray-400"></i>
                        </div>
                    </div>

                    <div class="mt-6 space-y-2" x-show="users.length > 0" x-cloak>
                        <template x-for="user in users" :key="user.id">
                            <a :href="'/@' + user.username"
                                class="flex items-center justify-between p-4 hover:bg-gray-50 rounded-xl transition border border-transparent hover:border-gray-100 group">

                                <div class="flex items-center gap-4">
                                    <template x-if="user.image">
                                        <img :src="user.image"
                                            class="w-12 h-12 rounded-full object-cover border border-gray-100 shadow-sm">
                                    </template>

                                    <template x-if="!user.image">
                                        <div
                                            class="w-12 h-12 rounded-full bg-neutral-900 flex items-center justify-center text-white text-xl font-bold shrink-0">
                                            <span x-text="user.name.charAt(0).toUpperCase()"></span>
                                        </div>
                                    </template>

                                    <div>
                                        <div class="font-bold text-gray-900" x-text="user.name"></div>
                                        <div class="text-sm text-gray-500" x-text="'@' + user.username"></div>
                                    </div>
                                </div>

                                <div class="text-gray-300 group-hover:text-black transition">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </div>
                            </a>
                        </template>
                    </div>

                    <div class="mt-8 text-center" x-show="search.length >= 2 && users.length === 0 && !loading" x-cloak>
                        <p class="text-gray-500 italic">No users found matching "<span x-text="search"></span>"</p>
                    </div>

                    <div class="mt-8 text-center" x-show="search.length < 2 && !loading">
                        <p class="text-gray-400 text-sm">Enter at least 2 characters to search...</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
