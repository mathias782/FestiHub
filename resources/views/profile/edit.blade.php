<form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
    @csrf
    @method('patch')

    {{-- Bestaande name/email velden blijven staan --}}

    <div class="mt-4">
        <x-input-label for="username" value="Username" />
        <x-text-input id="username" name="username" type="text" class="mt-1 block w-full"
                      value="{{ old('username', $user->username) }}" />
        <x-input-error :messages="$errors->get('username')" class="mt-2" />
    </div>

    <div class="mt-4">
        <x-input-label for="birthday" value="Verjaardag" />
        <x-text-input id="birthday" name="birthday" type="date" class="mt-1 block w-full"
                      value="{{ old('birthday', $user->birthday) }}" />
        <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
    </div>

    <div class="mt-4">
        <x-input-label for="avatar" value="Avatar" />
        <input id="avatar" name="avatar" type="file" accept="image/*" class="mt-1 block w-full" />
        <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
        @if($user->avatar_path)
            <img src="{{ asset('storage/'.$user->avatar_path) }}" alt="avatar" class="mt-2 w-24 h-24 rounded-full object-cover">
        @endif
    </div>

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
