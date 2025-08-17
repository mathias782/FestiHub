<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Username (publieke naam, optioneel) --}}
        <div>
            <x-input-label for="username" value="Username (publiek)" />
            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full"
                        value="{{ old('username', $user->username) }}" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
            <p class="text-xs text-gray-500 mt-1">Leeg laten = toon je echte naam.</p>
        </div>

        {{-- Verjaardag (optie: nette Y-m-d voor HTML date input) --}}
        <div>
            <x-input-label for="birthday" value="Verjaardag" />
            <x-text-input id="birthday" name="birthday" type="date" class="mt-1 block w-full"
                        value="{{ old('birthday', $user->birthday ? \Illuminate\Support\Carbon::parse($user->birthday)->format('Y-m-d') : '') }}" />
            <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
        </div>

        {{-- Avatar upload + preview --}}
        <div class="grid grid-cols-1 sm:grid-cols-[auto,1fr] gap-4 items-start">
            <div>
                @if($user->avatar_path)
                    <img src="{{ asset('storage/'.$user->avatar_path) }}" class="w-20 h-20 rounded-full object-cover ring-1 ring-gray-200" alt="avatar">
                @else
                    <div class="w-20 h-20 rounded-full bg-gray-100 grid place-items-center text-gray-500">?</div>
                @endif
            </div>
            <div>
                <x-input-label for="avatar" value="Avatar" />
                <input id="avatar" name="avatar" type="file" accept="image/*" class="mt-1 block w-full text-sm" />
                <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
                <p class="text-xs text-gray-500 mt-1">PNG/JPG, max 2MB.</p>
            </div>
        </div>

        {{-- Over mij --}}
        <div>
            <x-input-label for="about" value="Over mij" />
            <textarea id="about" name="about" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('about', $user->about) }}</textarea>
            <x-input-error :messages="$errors->get('about')" class="mt-2" />
        </div>

        {{-- Opslaan knop + feedback --}}


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
