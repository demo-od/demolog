<x-guest-layout>
    <div class="min-h-[400px] flex flex-col justify-center py-6 px-4">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">
                {{ __('Verify your email') }}
            </h1>
            <p class="mt-3 text-sm text-gray-500 max-w-xs mx-auto">
                {{ __('We sent a verification link to your inbox. Please click it to activate your account.') }}
            </p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-100 flex items-start space-x-3">
                <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <p class="text-sm font-medium text-green-800">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </p>
            </div>
        @endif

        <div class="space-y-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <x-submitButton class="w-full justify-center py-3 shadow-sm transition duration-150 ease-in-out">
                    {{ __('Resend Verification Email') }}
                </x-submitButton>
            </form>

            <div class="pt-4 border-t border-gray-100 flex flex-col items-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm font-semibold text-gray-500 hover:text-red-600 transition-colors focus:outline-none focus:underline">
                        {{ __('Not you? Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>