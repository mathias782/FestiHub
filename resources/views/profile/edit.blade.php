{{-- resources/views/profile/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">

            {{-- JOUW FORMULIER, in een kaartje --}}
            <div class="bg-white p-4 sm:p-8 shadow sm:rounded-lg">
                <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    {{-- Name (laat jouw bestaande name/email inputs hier staan als je die in deze view hebt) --}}
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                      :value="old('name', $user->name)" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                      :value="old('email', $user->email)" required autocomplete="username" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>

                    {{-- Username --}}
                    <div class="mt-4">
                        <x-input-label for="username" value="Username" />
                        <x-text-input id="username" name="username" type="text" class="mt-1 block w-full"
                                      value="{{ old('username', $user->username) }}" />
                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                    </div>

                    {{-- Verjaardag (let op: Y-m-d voor date inputs) --}}
                    <div class="mt-4">
                        <x-input-label for="birthday" value="Verjaardag" />
                        <x-text-input id="birthday" name="birthday" type="date" class="mt-1 block w-full"
                                      value="{{ old('birthday', $user->birthday ? \Illuminate\Support\Carbon::parse($user->birthday)->format('Y-m-d') : '') }}" />
                        <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
                    </div>

                    {{-- Avatar upload + preview --}}
                    <div class="mt-4">
                        <x-input-label for="avatar" value="Avatar" />
                        <input id="avatar" name="avatar" type="file" accept="image/*" class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
                        @if($user->avatar_path)
                            <img src="{{ asset('storage/'.$user->avatar_path) }}" alt="avatar" class="mt-2 w-24 h-24 rounded-full object-cover">
                        @endif
                    </div>

                    {{-- Over mij --}}
                    <div class="mt-4">
                        <x-input-label for="about" value="Over mij" />
                        <textarea id="about" name="about" rows="4" class="mt-1 block w-full border-gray-300 rounded">{{ old('about', $user->about) }}</textarea>
                        <x-input-error :messages="$errors->get('about')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>Opslaan</x-primary-button>
                        @if (session('status') === 'profile-updated' || session('status') === 'Profile updated')
                            <p class="text-sm text-gray-600">Opgeslagen.</p>
                        @endif
                    </div>
                </form>

                <hr class="mt-12 mb-8 border-t-2 border-gray-300">

                <div class="space-y-10">
                    {{-- PERFORMING AT --}}
                    <section>
                    <h3 class="mb-3 text-lg font-semibold text-gray-900">Performing at</h3>
                        @if($user->performerEvents->isEmpty())
                            <p class="text-gray-500">No performances.</p>
                        @else
                            <ul class="list-disc list-inside space-y-3">
                                @foreach($user->performerEvents as $e)
                                    <li>
                                        <a href="{{ route('events.show', $e) }}"
                                        class="font-medium text-gray-900 hover:underline">
                                            {{ $e->title }}
                                        </a>
                                        <div class="text-sm text-gray-500">
                                            {{ $e->starts_at->format('d/m/Y H:i') }}
                                            @if($e->ends_at) — {{ $e->ends_at->format('d/m/Y H:i') }} @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </section>

                    {{-- GOING TO --}}
                    <section>
                    <h3 class="mb-3 text-lg font-semibold text-gray-900">Going to</h3>
                        @if($user->events->isEmpty())
                            <p class="text-gray-500">No registrations.</p>
                        @else
                            <ul class="list-disc list-inside space-y-3">
                                @foreach($user->events as $e)
                                    <li>
                                        <a href="{{ route('events.show', $e) }}"
                                        class="font-medium text-gray-900 hover:underline">
                                            {{ $e->title }}
                                        </a>
                                        <div class="text-sm text-gray-500">
                                            {{ $e->starts_at->format('d/m/Y H:i') }}
                                            @if($e->ends_at) — {{ $e->ends_at->format('d/m/Y H:i') }} @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </section>
                </div>
            </div>

            {{-- (optioneel) laat de Breeze-secties staan als je ze had: --}}
            @if (View::exists('profile.partials.update-password-form'))
                <div class="bg-white p-4 sm:p-8 shadow sm:rounded-lg">
                    @include('profile.partials.update-password-form')
                </div>
            @endif

            @if (View::exists('profile.partials.delete-user-form'))
                <div class="bg-white p-4 sm:p-8 shadow sm:rounded-lg">
                    @include('profile.partials.delete-user-form')
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
