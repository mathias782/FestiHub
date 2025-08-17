<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-semibold leading-tight text-gray-800">Events beheren</h2></x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-6xl px-4 space-y-6">
            <div class="flex justify-end">
                <a href="{{ route('admin.events.create') }}" class="inline-flex items-center rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">Nieuw event</a>
            </div>

            <div class="bg-white rounded-xl shadow overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2">Titel</th>
                            <th class="px-4 py-2">Start</th>
                            <th class="px-4 py-2">Capaciteit</th>
                            <th class="px-4 py-2">Inschrijvingen</th>
                            <th class="px-4 py-2">Acties</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $e)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $e->title }}</td>
                                <td class="px-4 py-2">{{ $e->starts_at->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-2">{{ $e->capacity }}</td>
                                <td class="px-4 py-2">{{ $e->attendees_count }}</td>
                                <td class="px-4 py-2">
                                    <a class="text-indigo-600 hover:underline" href="{{ route('admin.events.edit', $e) }}">Bewerken</a>
                                    <a class="ml-3 text-sky-600 hover:underline" href="{{ route('admin.events.attendees', $e) }}">Bekijk inschrijvingen</a>
                                    <form method="POST" action="{{ route('admin.events.destroy', $e) }}" class="inline" onsubmit="return confirm('Verwijderen?')">
                                        @csrf @method('DELETE')
                                        <button class="ml-3 text-red-600 hover:underline">Verwijderen</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $events->links() }}
        </div>
    </div>
</x-app-layout>
