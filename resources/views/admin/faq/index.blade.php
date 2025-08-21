<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Manage FAQ</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-5xl px-4 space-y-8">
            {{-- Flash --}}
            @if(session('status'))
                <div class="rounded bg-green-50 text-green-700 px-3 py-2">
                    {{ session('status') }}
                </div>
            @endif

            {{-- CREATE CATEGORY --}}
            <section class="bg-white rounded-xl shadow-sm ring-1 ring-gray-100 p-4">
                <h3 class="font-semibold text-gray-900 mb-3">New category</h3>
                <form method="POST" action="{{ route('admin.faq.categories.store') }}"
                      class="grid sm:grid-cols-[1fr,140px,auto] gap-3">
                    @csrf
                    <input name="name" placeholder="Name" class="rounded border-gray-300" required>
                    <input name="sort_order" type="number" min="0" placeholder="Sort" class="rounded border-gray-300">
                    <x-primary-button>Create</x-primary-button>
                </form>
            </section>

            {{-- LIST CATEGORIES --}}
            @forelse($cats as $category)
                {{-- 1 SCOPE per categorie --}}
                <section class="bg-white rounded-xl shadow-sm ring-1 ring-gray-100"
                         x-data="{ open:false }">
                    {{-- HEADER --}}
                    <div class="px-4 py-3 border-b border-gray-100 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $category->name }}</h3>
                            <div class="text-xs text-gray-500">Sort: {{ $category->sort_order }}</div>
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="button"
                                    @click="open = !open"
                                    class="text-indigo-600 hover:underline">
                                <span x-show="!open">Edit</span>
                                <span x-show="open">Close</span>
                            </button>

                            <form method="POST" action="{{ route('admin.faq.categories.destroy', $category) }}"
                                  onsubmit="return confirm('Delete this category (and its items)?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:underline">Delete category</button>
                            </form>
                        </div>
                    </div>

                    {{-- CATEGORY INLINE EDIT (ZELFDE SCOPE) --}}
                    <div class="px-4 py-4 border-b border-gray-100"
                         x-show="open" x-transition>
                        <form method="POST" action="{{ route('admin.faq.categories.update', $category) }}"
                              class="grid sm:grid-cols-[1fr,8rem,auto] gap-3">
                            @csrf @method('PATCH')
                            <input name="name" value="{{ old('name', $category->name) }}"
                                   class="rounded border-gray-300" required>
                            <input name="sort_order" type="number" min="0"
                                   value="{{ old('sort_order', $category->sort_order) }}"
                                   class="rounded border-gray-300" placeholder="Sort">
                            <x-secondary-button type="submit">Update</x-secondary-button>
                        </form>
                    </div>

                    {{-- ITEMS --}}
                    <div class="px-4 py-4 space-y-6">
                        @forelse($category->items as $item)
                            <div class="pt-4 border-t border-gray-100 first:pt-0 first:border-0">
                                {{-- UPDATE ITEM (eigen form) --}}
                                <form method="POST" action="{{ route('admin.faq.items.update', $item) }}" class="space-y-3">
                                    @csrf @method('PATCH')

                                    <div class="grid sm:grid-cols-2 gap-3">
                                        <div class="flex items-center gap-2">
                                            <input name="question" value="{{ old('question', $item->question) }}"
                                                   class="flex-1 rounded border-gray-300" required>
                                            @if(blank($item->answer))
                                                <span class="px-2 py-1 text-xs rounded-full bg-amber-100 text-amber-800">Pending</span>
                                            @endif
                                        </div>

                                        <select name="faq_category_id" class="rounded border-gray-300">
                                            @foreach($allCats as $catForSelect)
                                                <option value="{{ $catForSelect->id }}"
                                                    @selected($catForSelect->id === $item->faq_category_id)>
                                                    {{ $catForSelect->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <textarea name="answer" rows="3" class="w-full rounded border-gray-300"
                                              placeholder="Answer (optional)">{{ old('answer', $item->answer) }}</textarea>

                                    <x-secondary-button type="submit">Save</x-secondary-button>
                                </form>

                                {{-- DELETE ITEM (apart form, niet genest) --}}
                                <form method="POST" action="{{ route('admin.faq.items.destroy', $item) }}"
                                      onsubmit="return confirm('Delete this FAQ item?')" class="mt-2">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </div>
                        @empty
                            <p class="text-gray-500">No items yet.</p>
                        @endforelse
                    </div>

                    {{-- CREATE ITEM IN THIS CATEGORY --}}
                    <div class="px-4 py-4 border-t border-gray-100">
                        <h4 class="font-medium text-gray-900 mb-2">Add item to “{{ $category->name }}”</h4>
                        <form method="POST" action="{{ route('admin.faq.items.store') }}" class="space-y-3">
                            @csrf
                            <input type="hidden" name="faq_category_id" value="{{ $category->id }}">
                            <input name="question" class="w-full rounded border-gray-300"
                                   placeholder="Question" required maxlength="255">
                            <textarea name="answer" rows="3" class="w-full rounded border-gray-300"
                                      placeholder="Answer" required></textarea>
                            <x-primary-button>Add item</x-primary-button>
                        </form>
                    </div>
                </section>
            @empty
                <p class="text-gray-500">No categories yet.</p>
            @endforelse
        </div>
    </div>

    {{-- Fallback voor gebruikers zonder JS: toon altijd het edit-form --}}
    <noscript>
        <style>
            [x-data] [x-show] { display:block !important; }
        </style>
    </noscript>
</x-app-layout>
