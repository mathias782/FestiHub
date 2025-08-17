<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">User Management</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-6xl px-4 space-y-6">

            @if (session('status'))
                <div class="rounded bg-green-50 text-green-700 px-3 py-2">{{ session('status') }}</div>
            @endif

            {{-- Create user --}}
            <div class="bg-white p-4 sm:p-6 rounded-xl shadow">
                <h3 class="font-semibold mb-3">Create new user</h3>
                <form method="POST" action="{{ route('admin.users.store') }}" class="grid grid-cols-1 md:grid-cols-4 gap-3">
                    @csrf
                    <div>
                        <x-input-label for="name" value="Name" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="email" value="Email" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="password" value="Password" />
                        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="flex items-end">
                        <label class="inline-flex items-center gap-2">
                            <input type="checkbox" name="is_admin" value="1" class="rounded border-gray-300">
                            <span>Admin</span>
                        </label>
                    </div>
                    <div class="md:col-span-4">
                        <x-primary-button>Create</x-primary-button>
                    </div>
                </form>
            </div>

            {{-- All users --}}
            <div class="bg-white p-4 sm:p-6 rounded-xl shadow">
                <h3 class="font-semibold mb-3">All users</h3>

                <div class="overflow-x-auto">
                    <table class="w-full table-fixed text-left">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 w-2/5">Name</th>
                                <th class="px-4 py-2 w-2/5">Email</th>
                                <th class="px-4 py-2 w-1/12 text-center">Admin</th>
                                <th class="px-4 py-2 w-1/12 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $u)
                                <tr class="border-t">
                                    <td class="px-4 py-2 truncate">{{ $u->username ?? $u->name }}</td>
                                    <td class="px-4 py-2 truncate">{{ $u->email }}</td>
                                    <td class="px-4 py-2 text-center">{{ $u->is_admin ? 'Yes' : 'No' }}</td>
                                    <td class="px-4 py-2 text-center">
                                        <form method="POST" action="{{ route('admin.users.update', $u) }}" class="inline">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="is_admin" value="{{ $u->is_admin ? 0 : 1 }}">
                                            {{-- IMPORTANT: type="submit" so it actually posts --}}
                                            @if($u->is_admin)
                                                <x-secondary-button type="submit">Demote</x-secondary-button>
                                            @else
                                                <x-primary-button>Promote</x-primary-button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
