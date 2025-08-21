<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Profile</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4">

            {{-- BASIC INFO (geen kaders) --}}
            <div class="flex items-start gap-4">
                @if($user->avatar_path)
                    <img src="{{ asset('storage/'.$user->avatar_path) }}"
                         class="w-16 h-16 rounded-full object-cover" alt="avatar">
                @else
                    <div class="w-16 h-16 rounded-full bg-gray-100 grid place-items-center text-gray-500">?</div>
                @endif

                <div>
                    <div class="text-2xl font-semibold text-gray-900">
                        {{ $user->username ?? $user->name }}
                    </div>
                    <div class="text-sm text-gray-500 mt-1">
                        Email: {{ $user->email }}
                    </div>

                    @if($user->birthday)
                        <div class="text-sm text-gray-500 mt-1">
                            Birthday: {{ \Illuminate\Support\Carbon::parse($user->birthday)->format('d/m/Y') }}
                        </div>
                    @endif

                    @if($user->about)
                        About:
                        <p class="mt-2 text-gray-700 leading-relaxed">{{ $user->about }}</p>
                    @endif
                </div>
            </div>

            <hr class="my-8 border-t-2 border-gray-300">

            {{-- PERFORMING AT --}}
            <h3 class="mt-10 mb-3 text-lg font-semibold text-gray-900">Performing at</h3>
            @if($user->performerEvents->isEmpty())
                <p class="text-gray-500">No performances.</p>
            @else
                <ul class="list-disc list-inside space-y-3">
                    @foreach($user->performerEvents as $e)
                        <li>
                            <a href="{{ route('events.show', $e) }}"
                               class="font-medium text-gray-900 hover:underline">
                                {{ $e->title }}
                            </a>
                            <div class="text-sm text-gray-500">
                                {{ $e->starts_at->format('d/m/Y H:i') }}
                                @if($e->ends_at) — {{ $e->ends_at->format('d/m/Y H:i') }} @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif

            {{-- GOING TO --}}
            <h3 class="mt-10 mb-3 text-lg font-semibold text-gray-900">Going to</h3>
            @if($user->events->isEmpty())
                <p class="text-gray-500">No registrations.</p>
            @else
                <ul class="list-disc list-inside space-y-3">
                    @foreach($user->events as $e)
                        <li>
                            <a href="{{ route('events.show', $e) }}"
                               class="font-medium text-gray-900 hover:underline">
                                {{ $e->title }}
                            </a>
                            <div class="text-sm text-gray-500">
                                {{ $e->starts_at->format('d/m/Y H:i') }}
                                @if($e->ends_at) — {{ $e->ends_at->format('d/m/Y H:i') }} @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif

        </div>
    </div>
</x-app-layout>
