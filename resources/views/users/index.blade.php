<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Users</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto px-4">
            <form method="GET" action="{{ route('users.index') }}" class="mb-4 flex gap-2">
                <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="Search users..."
                       class="w-full rounded border-gray-300" />
                <x-secondary-button type="submit">Search</x-secondary-button>
            </form>

            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4">
                @forelse($users as $u)
                    <a href="{{ route('users.show', $u) }}" class="bg-white rounded-xl p-4 shadow-sm ring-1 ring-gray-100 flex gap-3">
                        @if($u->avatar_path)
                            <img src="{{ asset('storage/'.$u->avatar_path) }}" class="w-12 h-12 rounded-full object-cover" alt="">
                        @else
                            <div class="w-12 h-12 rounded-full bg-gray-100 grid place-items-center text-gray-500">?</div>
                        @endif
                        <div>
                            <div class="font-semibold">{{ $u->username ?? $u->name }}</div>
                            <div class="text-sm text-gray-500">{{ $u->email }}</div>
                        </div>
                    </a>
                @empty
                    <p class="text-gray-500">No users found.</p>
                @endforelse
            </div>

            <div class="mt-4">{{ $users->links() }}</div>
        </div>
    </div>
</x-app-layout>
