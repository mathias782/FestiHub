<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Events</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto px-4 space-y-4">

            @forelse($events as $event)
                <div class="bg-white rounded-xl p-4 shadow-sm ring-1 ring-gray-100 flex items-center justify-between">
                    <div>
                        <a href="{{ route('events.show', $event) }}" class="text-lg font-semibold text-gray-900">
                            {{ $event->title }}
                            @if($event->location)
                                — <span class="text-gray-500">{{ $event->location }}</span>
                            @endif
                        </a>

                        <div class="text-sm text-gray-500">
                            {{ $event->starts_at->format('d/m/Y H:i') }}
                            @if($event->ends_at)
                                — {{ $event->ends_at->format('d/m/Y H:i') }}
                            @endif
                            · Spots left: {{ $event->spotsLeft() }}
                        </div>

                        @if($event->performers->count())
                            <div class="text-sm text-gray-500 mt-1">
                                Performers:
                                {{ $event->performers->map(fn($u) => $u->username ?? $u->name)->implode(', ') }}
                            </div>
                        @endif
                    </div>

                    <div class="ml-4">
                        @auth
                            @php $isGoing = $event->attendees->contains(auth()->id()); @endphp

                            @if(!$isGoing)
                                <form method="POST" action="{{ route('events.register', $event) }}" class="inline">
                                    @csrf
                                    <x-primary-button>Register</x-primary-button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('events.unregister', $event) }}" class="inline">
                                    @csrf @method('DELETE')
                                    <x-secondary-button type="submit">Unregister</x-secondary-button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:underline">
                                Log in to register
                            </a>
                        @endauth
                    </div>
                </div>
            @empty
                <p class="text-gray-500">No events yet.</p>
            @endforelse

        </div>
    </div>
</x-app-layout>
