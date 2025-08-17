{{-- Brede landing i.p.v. smalle guest-auth card --}}
<x-app-layout>
    <div class="relative min-h-[70vh] overflow-hidden bg-gradient-to-b from-indigo-50 via-white to-white">
        <div class="relative mx-auto max-w-6xl px-6 pt-20 pb-20 text-center">
            <h1 class="text-5xl font-extrabold tracking-tight text-gray-900">
                Welcome to <span class="text-indigo-600">FestiHub</span>
            </h1>

            <p class="mt-5 text-xl text-gray-600 leading-8">
                The place to discover music events, view your favorite artists, and register for performances.
            </p>

            <div class="mt-10 flex flex-wrap items-center justify-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center rounded-lg bg-red-600 px-6 py-3 text-white font-semibold hover:bg-red-700">
                        Go to dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center rounded-lg bg-red-600 px-6 py-3 text-white font-semibold hover:bg-red-700">
                        Log in
                    </a>
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center rounded-lg border border-gray-300 px-6 py-3 font-semibold text-gray-700 hover:bg-gray-50">
                        Create account
                    </a>
                @endauth

                <a href="{{ route('events.index') }}"
                   class="inline-flex items-center rounded-lg border border-gray-300 px-6 py-3 font-semibold text-gray-700 hover:bg-gray-50">
                    Browse events
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
