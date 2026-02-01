<x-guest-layout>
    <div class="py-6">
        <x-slot:header>
            <div class="text-center">
                <h1 class="font-extrabold text-3xl text-gray-900 tracking-tight">Welcome Back</h1>
                <p class="text-sm text-gray-500 mt-2">Please enter your details to sign in</p>
            </div>
        </x-slot>

        @if (session('status'))
            <div class="mb-4">
                <x-status class="bg-blue-50 border border-blue-100 text-blue-700 p-3 rounded-lg text-sm">
                    {{ session('status') }}
                </x-status>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <x-input-label for="email" :value="__('Email')" class="font-semibold text-gray-700" />
                <x-text-input id="email" 
                    class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" 
                    type="email" name="email" :value="old('email')" 
                    required autofocus autocomplete="username" 
                    placeholder="name@company.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <x-input-label for="password" :value="__('Password')" class="font-semibold text-gray-700" />
                    @if (Route::has('password.request'))
                        <a class="text-xs font-semibold text-blue-600 hover:text-blue-500 transition-colors" href="{{ route('password.request') }}">
                            {{ __('Forgot password?') }}
                        </a>
                    @endif
                </div>

                <x-text-input id="password" 
                    class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" 
                    type="password" name="password" 
                    required autocomplete="current-password" 
                    placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <div class="flex items-center">
                <input id="remember_me" type="checkbox"
                    class="h-4 w-4 rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" 
                    name="remember">
                <label for="remember_me" class="ms-2 text-sm text-gray-600 cursor-pointer select-none">
                    {{ __('Keep me signed in') }}
                </label>
            </div>

            <div class="pt-2">
                <x-submitButton class="w-full justify-center py-3 text-sm font-bold tracking-wide uppercase shadow-lg shadow-blue-200/50 transition-all active:scale-[0.98]">
                    SIGN IN
                </x-submitButton>
            </div>

            <div class="text-center pt-4 border-t border-gray-100">
                <p class="text-sm text-gray-500">
                    {{ __("Don't have an account?") }}
                    <a href="/register" class="font-bold text-blue-600 hover:text-blue-500 transition-colors ms-1">
                        {{ __('Sign up') }}
                    </a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>