<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Demolog') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-sans antialiased">
    <div class="relative overflow-hidden min-h-screen">
        
        <div aria-hidden="true" class="flex absolute -top-96 start-1/2 transform -translate-x-1/2 pointer-events-none z-0">
            <div class="bg-linear-to-r from-violet-300/50 to-purple-100 blur-3xl w-[40rem] h-[50rem] rotate-[-60deg] transform -translate-x-40"></div>
            
            <div class="bg-linear-to-tl from-blue-100 via-blue-200 to-indigo-50 blur-3xl w-[90rem] h-[50rem] rounded-full origin-top-left -rotate-12 -translate-x-60"></div>
        </div>

        <div class="relative z-10 flex items-center min-h-screen">
            <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-16">
                <div class="max-w-2xl text-center mx-auto">
                    
                    <p class="inline-block text-sm font-semibold bg-clip-text bg-linear-to-l from-blue-600 to-violet-500 text-transparent uppercase tracking-wider mb-5">
                        The Multi-Author Platform
                    </p>

                    <h1 class="block font-bold text-gray-800 text-4xl md:text-5xl lg:text-7xl tracking-tight leading-tight">
                        Welcome to <span class="text-blue-600">Demolog</span>
                    </h1>

                    <div class="mt-8 max-w-3xl">
                        <p class="text-lg md:text-xl text-gray-600 leading-relaxed">
                            Share your insights on <span class="text-gray-900 font-medium">Science</span>, 
                            <span class="text-gray-900 font-medium">Sports</span>, 
                            <span class="text-gray-900 font-medium">Politics
                                and more!  </span> 
                            Connect with a community of thinkers and writers.
                        </p>
                    </div>

                    <div class="mt-10 gap-4 flex flex-col sm:flex-row justify-center items-center">
                        <a href="{{ route('register') }}" class="w-full sm:w-auto py-3 px-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all shadow-xl shadow-blue-200">
                            Get Started
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                        </a>
                        
                        <a href="{{ route('login') }}" class="w-full sm:w-auto py-3 px-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-xl border border-gray-200 bg-white/80 backdrop-blur-sm text-gray-800 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200 transition-all">
                            Sign In
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
</html>