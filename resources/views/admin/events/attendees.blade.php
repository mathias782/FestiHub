<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-semibold leading-tight text-gray-800">Inschrijvingen — {{ $event->title }}</h2></x-slot>
    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 space-y-4">
            <div class="bg-white p-6 rounded-xl shadow">
                <p class="mb-3 text-gray-600">Capaciteit: {{ $event->capacity }} • Ingeschreven: {{ $event->attendees->count() }}</p>
                <ul class="list-disc ml-5">
                    @forelse($event->attendees as $a)
                        <li>{{ $a->username ?? $a->name }} — {{ $a->email }}</li>
                    @empty
                        <li class="text-gray-500">Nog geen inschrijvingen.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
