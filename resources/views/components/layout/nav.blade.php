<div class="mx-auto flex justify-between items-center bg-tm-orange">
    <!-- Logo -->
    <div class="flex p-4 items-center bg-white">
        <a href="#">
            <img src="{{ asset('thomasmore_logo_oranje.svg') }}" alt="Thomas more logo" class="h-10">
        </a>
    </div>

    <!-- Navbar -->
    <nav class="flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <a class="hidden sm:block font-medium text-lg" href="#">
            </a>
        </div>

        {{-- Rechter dropdown (user) --}}
        <div class="relative me-4" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center space-x-2 text-white">
                <span>USER</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 12a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    <path fill-rule="evenodd" d="M10 0a8 8 0 100 16 8 8 0 000-16zM0 10a10 10 0 1120 0 10 10 0 01-20 0z" clip-rule="evenodd" />
                </svg>
            </button>
            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-56 bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
                <a href="{{ route('compcat') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Manage competition categories</a>
                <a href="{{ route('notifications') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Manage notifications</a>
            </div>
        </div>
    </nav>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.3.0/dist/alpine.js" defer></script>
