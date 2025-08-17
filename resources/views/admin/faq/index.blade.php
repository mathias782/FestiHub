<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-semibold leading-tight text-gray-800">FAQ beheren</h2></x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-5xl px-4 space-y-6">
            @if (session('status'))
                <div class="rounded bg-green-50 text-green-700 px-3 py-2">{{ session('status') }}</div>
            @endif

            <div class="bg-white p-4 rounded-xl shadow">
                <h3 class="font-semibold mb-2">Nieuwe categorie</h3>
                <form method="POST" action="{{ route('admin.faq.categories.store') }}" class="flex gap-3">
                    @csrf
                    <x-text-input name="name" placeholder="Naam" required />
                    <x-text-input name="sort_order" type="number" placeholder="Sort" />
                    <x-primary-button>Aanmaken</x-primary-button>
                </form>
            </div>

            <div class="space-y-6">
                @foreach($cats as $cat)
                    <div class="bg-white p-4 rounded-xl shadow">
                        <div class="flex items-center justify-between">
                            <h3 class="font-semibold">{{ $cat->name }}</h3>
                            <form method="POST" action="{{ route('admin.faq.categories.destroy', $cat) }}" onsubmit="return confirm('Verwijderen?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:underline">Verwijder categorie</button>
                            </form>
                        </div>

                        <ul class="mt-3 list-disc ml-5">
                            @foreach($cat->items as $q)
                                <li class="flex items-start justify-between">
                                    <div>
                                        <span class="font-medium">{{ $q->question }}</span>
                                        <div class="text-gray-700">{{ $q->answer }}</div>
                                    </div>
                                    <form method="POST" action="{{ route('admin.faq.items.destroy', $q) }}">
                                        @csrf @method('DELETE')
                                        <button class="text-red-600 hover:underline">Verwijderen</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>

                        <form method="POST" action="{{ route('admin.faq.items.store') }}" class="mt-3 space-y-3">
                            @csrf
                            <input type="hidden" name="faq_category_id" value="{{ $cat->id }}">
                            <x-text-input name="question" placeholder="Vraag" class="block w-full" required />
                            <textarea name="answer" rows="3" class="block w-full border-gray-300 rounded" placeholder="Antwoord" required></textarea>
                            <x-primary-button>Vraag toevoegen</x-primary-button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
