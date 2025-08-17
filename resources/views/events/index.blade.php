<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-semibold leading-tight text-gray-800">Events</h2></x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-5xl px-4 space-y-4">
            @foreach($events as $e)
                <div class="bg-white p-4 rounded-xl shadow flex items-center justify-between">
                    <div>
                        <a class="text-lg font-semibold hover:underline" href="{{ route('events.show', $e) }}">
                            {{ $e->title }} @if($e->location) — {{ $e->location }} @endif
                        </a>
                        <p class="text-sm text-gray-500">
                            {{ $e->starts_at->format('d/m H:i') }}
                            @if($e->ends_at)– {{ $e->ends_at->format('H:i') }} @endif
                            • Spots left: {{ $e->spotsLeft() }}
                        </p>
                        @if($e->performers->count())
                            <p class="text-sm text-gray-600">Artiesten:
                                {{ $e->performers->pluck('username','name')->map(fn($u,$n) => $u ?: $n)->values()->join(', ') }}
                            </p>
                        @endif
                    </div>
                    <div>
                        @auth
                            @if(!$e->attendees->contains(auth()->id()))
                                <form method="POST" action="{{ route('events.register', $e) }}">
                                    @csrf
                                    <x-primary-button>Inschrijven</x-primary-button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('events.unregister', $e) }}">
                                    @csrf @method('DELETE')
                                    <x-secondary-button>Uitschrijven</x-secondary-button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            @endforeach

            {{ $events->links() }}
        </div>
    </div>
</x-app-layout>
