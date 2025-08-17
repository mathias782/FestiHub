<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-semibold leading-tight text-gray-800">{{ $event->title }}</h2></x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 space-y-4">
            <p class="text-gray-600">
                {{ $event->starts_at->format('d/m/Y H:i') }}
                @if($event->ends_at)– {{ $event->ends_at->format('H:i') }} @endif
                @if($event->location) • {{ $event->location }} @endif
            </p>

            @if($event->image_path)
                <img src="{{ asset('storage/'.$event->image_path) }}" class="rounded" alt="">
            @endif

            @if($event->description)
                <div class="prose max-w-none">{!! nl2br(e($event->description)) !!}</div>
            @endif

            <p class="text-sm text-gray-500">Ingeschreven: {{ $event->attendees->count() }} / {{ $event->capacity }}</p>

            @auth
                @if(!$event->attendees->contains(auth()->id()))
                    <form method="POST" action="{{ route('events.register', $event) }}">
                        @csrf
                        <x-primary-button>Inschrijven</x-primary-button>
                    </form>
                @else
                    <form method="POST" action="{{ route('events.unregister', $event) }}">
                        @csrf @method('DELETE')
                        <x-secondary-button>Uitschrijven</x-secondary-button>
                    </form>
                @endif
            @endauth

            @if($event->performers->count())
                <div class="pt-4">
                    <h3 class="font-semibold">Artiesten</h3>
                    <ul class="list-disc ml-5">
                        @foreach($event->performers as $p)
                            <li>{{ $p->username ?? $p->name }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
