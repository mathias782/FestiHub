<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-semibold leading-tight text-gray-800">Event aanmaken</h2></x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4">
            <div class="bg-white p-6 rounded-xl shadow space-y-4">
                <form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div>
                        <x-input-label for="title" value="Titel" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" value="{{ old('title') }}" required />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="starts_at" value="Start" />
                            <x-text-input id="starts_at" name="starts_at" type="datetime-local" class="mt-1 block w-full" value="{{ old('starts_at') }}" required />
                            <x-input-error :messages="$errors->get('starts_at')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="ends_at" value="Einde (optioneel)" />
                            <x-text-input id="ends_at" name="ends_at" type="datetime-local" class="mt-1 block w-full" value="{{ old('ends_at') }}" />
                            <x-input-error :messages="$errors->get('ends_at')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="location" value="Locatie" />
                            <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" value="{{ old('location') }}" />
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="capacity" value="Capaciteit" />
                            <x-text-input id="capacity" name="capacity" type="number" min="1" class="mt-1 block w-full" value="{{ old('capacity', 200) }}" required />
                            <x-input-error :messages="$errors->get('capacity')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="image" value="Afbeelding" />
                        <input id="image" name="image" type="file" accept="image/*" class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="description" value="Omschrijving" />
                        <textarea id="description" name="description" rows="6" class="mt-1 block w-full border-gray-300 rounded">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="performers" value="Artiesten (gebruikers)" />
                        <select id="performers" name="performers[]" multiple class="mt-1 block w-full border-gray-300 rounded">
                            @foreach($users as $u)
                                <option value="{{ $u->id }}">
                                    {{ $u->username ?? $u->name }} — {{ $u->email }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('performers')" class="mt-2" />
                    </div>

                    <x-primary-button>Aanmaken</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
