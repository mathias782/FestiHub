<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">Profiel</h2></x-slot>

    <div class="max-w-3xl mx-auto p-4 bg-white rounded-xl shadow space-y-4">
        <div class="flex items-center gap-4">
            @if($user->avatar_path)
                <img src="{{ asset('storage/'.$user->avatar_path) }}" class="w-24 h-24 rounded-full object-cover" alt="avatar">
            @else
                <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">?</div>
            @endif
            <div>
                <h3 class="text-2xl font-bold">{{ $user->username ?? $user->name }}</h3>
                @if($user->birthday)
                    <p class="text-gray-600">Verjaardag: {{ \Illuminate\Support\Carbon::parse($user->birthday)->format('d/m/Y') }}</p>
                @endif
                @if($user->about)
                    <p class="mt-2">{{ $user->about }}</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
