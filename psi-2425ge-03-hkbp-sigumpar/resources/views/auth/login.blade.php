<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="bg-white p-6 rounded-lg shadow-md max-w-md mx-auto">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Kata Sandi')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-6 gap-3">
            <div class="text-sm">
                @if (Route::has('password.request'))
                    <a class="underline text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Lupa kata sandi?') }}
                    </a>
                @endif
            </div>

            <x-primary-button>
                {{ __('Masuk') }}
            </x-primary-button>
        </div>

        <!-- Google Login -->
        <div class="mt-6">
            <a href="{{ url('login/google') }}"
               class="w-full inline-flex justify-center items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-gray-700 focus:outline-none transition ease-in-out duration-150">
                Masuk dengan Google
            </a>
        </div>

        <!-- Register Link -->
        <div class="mt-6 text-center">
            <span class="text-gray-600 text-sm">Belum punya akun?</span>
            <a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-800 font-semibold underline ml-1">
                Daftar sekarang
            </a>
        </div>
    </form>
</x-guest-layout>
