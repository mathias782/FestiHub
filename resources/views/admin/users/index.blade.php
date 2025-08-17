<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-semibold leading-tight text-gray-800">Gebruikersbeheer</h2></x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-6xl px-4 space-y-6">
            @if (session('status'))
                <div class="rounded bg-green-50 text-green-700 px-3 py-2">{{ session('status') }}</div>
            @endif

            <div class="bg-white p-4 rounded-xl shadow">
                <h3 class="font-semibold mb-2">Nieuwe gebruiker</h3>
                <form method="POST" action="{{ route('admin.users.store') }}" class="grid grid-cols-1 md:grid-cols-4 gap-3">
                    @csrf
                    <x-text-input name="name" placeholder="Naam" required />
                    <x-text-input type="email" name="email" placeholder="Email" required />
                    <x-text-input type="password" name="password" placeholder="Wachtwoord" required />
                    <label class="inline-flex items-center gap-2">
                        <input type="checkbox" name="is_admin" value="1" class="rounded border-gray-300" />
                        Admin
                    </label>
                    <div class="md:col-span-4">
                        <x-primary-button>Aanmaken</x-primary-button>
                    </div>
                </form>
            </div>

            <div class="bg-white p-4 rounded-xl shadow">
                <h3 class="font-semibold mb-2">Alle gebruikers</h3>
                <table class="w-full text-left">
                    <thead><tr><th>Naam</th><th>Email</th><th>Admin</th><th>Actie</th></tr></thead>
                    <tbody>
                    @foreach($users as $u)
                        <tr class="border-t">
                            <td class="py-2">{{ $u->name }}</td>
                            <td class="py-2">{{ $u->email }}</td>
                            <td class="py-2">{{ $u->is_admin ? 'Ja' : 'Nee' }}</td>
                            <td class="py-2">
                                <form method="POST" action="{{ route('admin.users.update', $u) }}" class="inline">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="is_admin" value="{{ $u->is_admin ? 0 : 1 }}">
                                    <x-secondary-button>{{ $u->is_admin ? 'Demote' : 'Promote' }}</x-secondary-button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
