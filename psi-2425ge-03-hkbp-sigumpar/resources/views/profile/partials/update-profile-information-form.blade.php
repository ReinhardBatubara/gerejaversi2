<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile Information') }}
        </h2>
    </x-slot>

    <section class="max-w-3xl mx-auto p-6 bg-white rounded shadow" x-data="{ editing: false }">
        <header class="mb-6">
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Update your account\'s profile information and email address.') }}
            </h2>
        </header>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
            @csrf
            @method('patch')

            {{-- Name --}}
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input
                    id="name"
                    name="name"
                    type="text"
                    class="mt-1 block w-full rounded border border-gray-300 p-2 focus:border-indigo-500 focus:ring-indigo-500"
                    :value="old('name', $user->name)"
                    required
                    autofocus
                    autocomplete="name"
                    x-bind:disabled="!editing"
                />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            {{-- Email --}}
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input
                    id="email"
                    name="email"
                    type="email"
                    class="mt-1 block w-full rounded border border-gray-300 p-2 focus:border-indigo-500 focus:ring-indigo-500"
                    :value="old('email', $user->email)"
                    required
                    autocomplete="username"
                    x-bind:disabled="!editing"
                />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-2 text-sm text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button
                            form="send-verification"
                            class="ml-1 underline text-indigo-600 hover:text-indigo-900 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            x-bind:disabled="!editing"
                        >
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </div>
                @endif
            </div>

            {{-- WhatsApp Number --}}
            <div>
                <x-input-label for="wa_number" :value="__('Nomor WhatsApp')" />
                <x-text-input
                    id="wa_number"
                    name="wa_number"
                    type="text"
                    class="mt-1 block w-full rounded border border-gray-300 p-2 focus:border-indigo-500 focus:ring-indigo-500"
                    :value="old('wa_number', $user->wa_number)"
                    autocomplete="tel"
                    placeholder="contoh: +6281234567890"
                    x-bind:disabled="!editing"
                />
                <x-input-error class="mt-2" :messages="$errors->get('wa_number')" />
            </div>

            {{-- Tombol --}}
            <div class="flex items-center gap-4">
                <button
                    type="button"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    x-show="!editing"
                    x-on:click="editing = true"
                >
                    {{ __('Edit') }}
                </button>

                <x-primary-button
                    x-show="editing"
                    x-bind:disabled="!editing"
                >
                    {{ __('Save') }}
                </x-primary-button>

                <button
                    type="button"
                    class="inline-flex items-center px-4 py-2 text-gray-600 underline hover:text-gray-900 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    x-show="editing"
                    x-on:click="editing = false"
                >
                    {{ __('Cancel') }}
                </button>

                @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600"
                    >
                        {{ __('Saved.') }}
                    </p>
                @endif
            </div>
        </form>
    </section>
</x-app-layout>
