<x-guest-layout>
    <!-- Judul -->
    <div class="text-center mb-4">
        <h2 class="text-xl font-bold text-gray-900">Selamat Datang</h2>
        <p class="text-sm text-gray-600">Masuk ke sistem informasi Gereja HKBP Sigumpar</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Form Login -->
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me + Forgot -->
        <div class="flex items-center justify-between mb-4">
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <span class="text-sm text-gray-600">Ingat saya</span>
            </label>
            @if (Route::has('password.request'))
            @endif
        </div>

        <!-- Tombol Login -->
        <x-primary-button class="w-full justify-center">
            {{ __('Login') }}
        </x-primary-button>
    </form>

    <!-- Link ke Register -->
    <p class="mt-4 text-center text-sm text-gray-600">
        Belum punya akun?
        <a href="{{ route('register') }}" class="text-indigo-600 hover:underline font-medium">Daftar di sini</a>
    </p>
</x-guest-layout>
