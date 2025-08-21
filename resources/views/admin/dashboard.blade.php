<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">Admin dashboard</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                Welcome, {{ auth()->user()->name }}.
            </div>
        </div>
    </div>
</x-app-layout>
