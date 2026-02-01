<x-guest-layout>
    <div class="py-4">
        <x-slot:header>
            <div class="text-center">
                <h1 class="font-extrabold text-3xl text-gray-900 tracking-tight">Create an Account</h1>
                <p class="text-sm text-gray-500 mt-2">Join us today and get started</p>
            </div>
        </x-slot>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="name" :value="__('Full Name')" class="font-semibold text-gray-700" />
                    <x-text-input id="name" class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" type="text" name="name" :value="old('name')" required autofocus placeholder="John Doe" />
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>

                <div>
                    <x-input-label for="username" :value="__('Username')" class="font-semibold text-gray-700" />
                    <x-text-input id="username" class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" type="text" name="username" :value="old('username')" placeholder="johndoe123" />
                    <x-input-error :messages="$errors->get('username')" class="mt-1" />
                </div>
            </div>

            <div>
                <x-input-label for="email" :value="__('Email Address')" class="font-semibold text-gray-700" />
                <x-text-input id="email" class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" type="email" name="email" :value="old('email')" required placeholder="name@example.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="password" :value="__('Password')" class="font-semibold text-gray-700" />
                    <x-text-input id="password" class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm')" class="font-semibold text-gray-700" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" type="password" name="password_confirmation" required placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                </div>
            </div>

            <div class="pt-4">
                <x-submitButton class="w-full justify-center py-3 text-sm font-bold tracking-wide uppercase shadow-lg shadow-blue-200/50 transition-all active:scale-[0.98]">
                    {{ __('Register Now') }}
                </x-submitButton>
            </div>

            <div class="text-center pt-4 border-t border-gray-100">
                <p class="text-sm text-gray-500">
                    {{ __('Already have an account?') }}
                    <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:text-blue-500 transition-colors ms-1">
                        {{ __('Log In') }}
                    </a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>