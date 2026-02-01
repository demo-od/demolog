<x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
        <x-status>{{ session('status') }}</x-status>
    @endif

    <form method="POST" action="{{ route('login') }}">

        @csrf

        <!-- Email Address -->
        <x-slot:header>
            <h1 class="font-bold text-3xl">Welcome Back</h1>
        </x-slot>
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <x-submitButton class="justify-center items-center w-full">LOG IN</x-submitButton>

        <div class="flex items-center justify-start mt-4">
            @if (Route::has('password.request'))
                <a class="text-blue-600 hover:text-blue-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif


        </div>
        <div class="mt-2">
            <span class="text-gray-500"> Don't have an account?</span> <a href="/register"
                class="text-blue-600 hover:text-blue-500">Sign up</a>
        </div>
    </form>
</x-guest-layout>
