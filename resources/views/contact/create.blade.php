<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-semibold leading-tight text-gray-800">Contact</h2></x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-md px-4">
            @if(session('status'))
                <div class="mb-4 bg-green-50 text-green-700 rounded px-3 py-2">{{ session('status') }}</div>
            @endif
            <form method="POST" action="{{ route('contact.store') }}" class="space-y-4">
                @csrf
                <div>
                    <x-input-label for="name" value="Name" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="email" value="Email" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="subject" value="Subject" />
                    <x-text-input id="subject" name="subject" type="text" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="message" value="Message" />
                    <textarea id="message" name="message" rows="5" class="mt-1 block w-full border-gray-300 rounded" required></textarea>
                    <x-input-error :messages="$errors->get('message')" class="mt-2" />
                </div>
                <x-primary-button>Send</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
