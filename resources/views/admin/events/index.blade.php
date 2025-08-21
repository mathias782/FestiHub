<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Manage Events</h2>

            <a href="{{ route('admin.events.create') }}"
               class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-black hover:bg-indigo-700">
                + Create event
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-6xl px-4 space-y-6">
            @if (session('status'))
                <div class="rounded bg-green-50 text-green-700 px-3 py-2">{{ session('status') }}</div>
            @endif
            <div class="bg-white rounded-xl shadow overflow-hidden">
                <table class="w-full table-fixed text-left">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 w-2/5">Title</th>
                            <th class="px-4 py-3 w-1/4">Date / Time</th>
                            <th class="px-4 py-3 w-1/12 text-center">Capacity</th>
                            <th class="px-4 py-3 w-1/12 text-center">Registrations</th>
                            <th class="px-4 py-3 w-1/6">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $e)
                            <tr class="border-t">
                                <td class="px-4 py-3 truncate">
                                    <span class="font-medium text-gray-900">{{ $e->title }}</span>
                                    @if($e->location)
                                        <span class="text-gray-500"> — {{ $e->location }}</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-gray-700">
                                    <div class="text-sm">
                                        {{ $e->starts_at->format('d/m/Y H:i') }}
                                        @if($e->ends_at)
                                            — {{ $e->ends_at->format('d/m/Y H:i') }}
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    {{ $e->capacity }}
                                </td>

                                {{-- Registrations (requires withCount('attendees') in controller) --}}
                                <td class="px-4 py-3 text-center">
                                    {{ $e->attendees_count ?? $e->attendees->count() }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex flex-col items-start gap-1">
                                        <a class="text-indigo-600 hover:underline"
                                           href="{{ route('admin.events.edit', $e) }}">Edit</a>

                                        <a class="text-sky-600 hover:underline"
                                           href="{{ route('admin.events.attendees', $e) }}">Attendees</a>

                                        <form method="POST" action="{{ route('admin.events.destroy', $e) }}"
                                              onsubmit="return confirm('Delete this event?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-4 py-6 text-gray-500" colspan="5">No events yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $events->links() }}
        </div>
    </div>
</x-app-layout>
