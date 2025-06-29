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

            {{-- Full Name --}}
            <div>
                <x-input-label for="full_name" :value="__('Nama Lengkap')" />
                <x-text-input
                    id="full_name"
                    name="full_name"
                    type="text"
                    class="mt-1 block w-full rounded border border-gray-300 p-2 focus:border-indigo-500 focus:ring-indigo-500"
                    :value="old('full_name', $user->full_name)"
                    x-bind:disabled="!editing"
                />
                <x-input-error class="mt-2" :messages="$errors->get('full_name')" />
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

            {{-- Address --}}
            <div>
                <x-input-label for="address" :value="__('Alamat')" />
                <x-text-input
                    id="address"
                    name="address"
                    type="text"
                    class="mt-1 block w-full rounded border border-gray-300 p-2 focus:border-indigo-500 focus:ring-indigo-500"
                    :value="old('address', $user->address)"
                    x-bind:disabled="!editing"
                />
                <x-input-error class="mt-2" :messages="$errors->get('address')" />
            </div>

            {{-- Umur --}}
            <div>
                <x-input-label for="age" :value="__('Umur')" />
                <x-text-input
                    id="age"
                    name="age"
                    type="text"
                    class="mt-1 block w-full rounded border border-gray-300 p-2 focus:border-indigo-500 focus:ring-indigo-500"
                    :value="old('age', $user->age)"
                    x-bind:disabled="!editing"
                />
                <x-input-error class="mt-2" :messages="$errors->get('age')" />
            </div>

            {{-- Lingkungan --}}
            <div>
                <x-input-label for="location" :value="__('Lingkungan')" />
                <x-text-input
                    id="location"
                    name="location"
                    type="text"
                    class="mt-1 block w-full rounded border border-gray-300 p-2 focus:border-indigo-500 focus:ring-indigo-500"
                    :value="old('location', $user->location)"
                    x-bind:disabled="!editing"
                />
                <x-input-error class="mt-2" :messages="$errors->get('location')" />
            </div>

            {{-- Father's Name --}}
            <div>
                <x-input-label for="father_name" :value="__('Nama Ayah')" />
                <x-text-input
                    id="father_name"
                    name="father_name"
                    type="text"
                    class="mt-1 block w-full rounded border border-gray-300 p-2 focus:border-indigo-500 focus:ring-indigo-500"
                    :value="old('father_name', $user->father_name)"
                    x-bind:disabled="!editing"
                />
                <x-input-error class="mt-2" :messages="$errors->get('father_name')" />
            </div>

            {{-- Mother's Name --}}
            <div>
                <x-input-label for="mother_name" :value="__('Nama Ibu')" />
                <x-text-input
                    id="mother_name"
                    name="mother_name"
                    type="text"
                    class="mt-1 block w-full rounded border border-gray-300 p-2 focus:border-indigo-500 focus:ring-indigo-500"
                    :value="old('mother_name', $user->mother_name)"
                    x-bind:disabled="!editing"
                />
                <x-input-error class="mt-2" :messages="$errors->get('mother_name')" />
            </div>

            {{-- Jenis Kelamin --}}
<div>
    <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
    <select
        id="jenis_kelamin"
        name="jenis_kelamin"
        class="mt-1 block w-full rounded border-gray-300 p-2 focus:border-indigo-500 focus:ring-indigo-500"
        x-model="gender"
        x-bind:disabled="!editing"
    >
        <option value="laki-laki" @selected(old('jenis_kelamin', $user->jenis_kelamin) === 'laki-laki')>Laki-laki</option>
        <option value="perempuan" @selected(old('jenis_kelamin', $user->jenis_kelamin) === 'perempuan')>Perempuan</option>
    </select>
    <x-input-error class="mt-2" :messages="$errors->get('jenis_kelamin')" />
</div>

{{-- Nama Pasangan --}}
<div>
    <x-input-label for="partner_name" :value="__('Nama Pasangan')" />
    <x-text-input
        id="partner_name"
        name="partner_name"
        type="text"
        class="mt-1 block w-full rounded border border-gray-300 p-2 focus:border-indigo-500 focus:ring-indigo-500"
        :value="old('partner_name', $user->jenis_kelamin === 'laki-laki' ? $user->wife_name : $user->husband_name)"
        x-bind:disabled="!editing"
    />
    <x-input-error class="mt-2" :messages="$errors->get('partner_name')" />
</div>

{{-- Nomor WA Pasangan --}}
<div>
    <x-input-label for="partner_wa" :value="__('Nomor WA Pasangan')" />
    <x-text-input
        id="partner_wa"
        name="partner_wa"
        type="text"
        class="mt-1 block w-full rounded border border-gray-300 p-2 focus:border-indigo-500 focus:ring-indigo-500"
        :value="old(
            'partner_wa',
            $user->jenis_kelamin === 'laki-laki'
                ? $user->wife_wa        // jika user laki-laki ambil WA istri
                : $user->husband_wa     // jika user perempuan ambil WA suami
        )"
        placeholder="contoh: +6281234567890"
        x-bind:disabled="!editing"
    />
    <x-input-error class="mt-2" :messages="$errors->get('partner_wa')" />
</div>

{{-- Umur Pasangan --}}
<div>
    <x-input-label for="partner_age" :value="__('Umur Pasangan')" />
    <x-text-input
        id="partner_age"
        name="partner_age"
        type="number"
        class="mt-1 block w-full rounded border border-gray-300 p-2 focus:border-indigo-500 focus:ring-indigo-500"
        :value="old(
            'partner_age',
            $user->jenis_kelamin === 'laki-laki'
                ? $user->wife_age        {{-- umur istri --}}
                : $user->husband_age     {{-- umur suami --}}
        )"
        min="1"
        x-bind:disabled="!editing"
    />
    <x-input-error class="mt-2" :messages="$errors->get('partner_age')" />
</div>

{{-- Lingkungan Pasangan --}}
<div>
    <x-input-label for="partner_location" :value="__('Lingkungan Pasangan')" />
    <x-text-input
        id="partner_location"
        name="partner_location"
        type="text"
        class="mt-1 block w-full rounded border border-gray-300 p-2 focus:border-indigo-500 focus:ring-indigo-500"
        :value="old(
            'partner_location',
            $user->jenis_kelamin === 'laki-laki'
                ? $user->wife_location    {{-- lokasi istri --}}
                : $user->husband_location {{-- lokasi suami --}}
        )"
        x-bind:disabled="!editing"
    />
    <x-input-error class="mt-2" :messages="$errors->get('partner_location')" />
</div>


{{-- Alamat Pasangan --}}
<div>
    <x-input-label for="partner_address" :value="__('Alamat Pasangan')" />
    <x-text-input
        id="partner_address"
        name="partner_address"
        type="text"
        class="mt-1 block w-full rounded border border-gray-300 p-2 focus:border-indigo-500 focus:ring-indigo-500"
        :value="old(
            'partner_address',
            $user->jenis_kelamin === 'laki-laki'
                ? $user->wife_address   // alamat istri jika user laki-laki
                : $user->husband_address// alamat suami jika user perempuan
        )"
        x-bind:disabled="!editing"
    />
    <x-input-error class="mt-2" :messages="$errors->get('partner_address')" />
</div>


            

            {{-- Buttons --}}
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
