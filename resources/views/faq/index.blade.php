<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-semibold leading-tight text-gray-800">FAQ</h2></x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-4xl px-4 space-y-6">
            @foreach($categories as $cat)
                <section class="bg-white p-4 rounded-xl shadow">
                    <h3 class="text-lg font-semibold">{{ $cat->name }}</h3>
                    <dl class="mt-3 space-y-2">
                        @foreach($cat->items as $q)
                            <dt class="font-medium">{{ $q->question }}</dt>
                            <dd class="text-gray-700">{{ $q->answer }}</dd>
                        @endforeach
                    </dl>
                </section>
            @endforeach
        </div>
    </div>
</x-app-layout>
