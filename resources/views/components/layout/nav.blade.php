<div class="mx-auto flex justify-between items-center bg-tm-orange">
    <!-- Logo -->
    <div class="flex p-4 items-center bg-white">
        <a href="{{ route('dashboard') }}">
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
                <span>
                    {{-- Normally you should be authenticated --}}
                    @auth
                        {{ auth()->user()->fullname }}
                    @else
                        USER
                    @endauth
                </span>
                @php
                $link = auth()->user()->profile_photo_path == null
                    ? asset('/assets/profile_pictures/default.jpg')
                    : Storage::url(auth()->user()->profile_photo_path);
                @endphp
                <img src="{{ $link }}" alt="Profile Photo" class="rounded-full h-10 w-10 object-cover">
            </button>
            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-56 bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg">
                @if(auth()->user()->user_roles()->where('role_id', 3)->exists())
                    <a href="{{ route('announcement') }}"
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Send announcement</a>
                    <div class="border-t border-gray-100"></div>
                @endif
                @if(auth()->user()->admin)
                    <a href="{{ route('admin.accept-competition') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">View proposals</a>
                    <a href="{{ route('admin.compcat') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Manage competition categories</a>
                    <a href="{{ route('admin.comptyp') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Manage submission types</a>
                    <a href="{{ route('admin.notifications') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Manage notifications</a>
                        <a href="{{ route('admin.users') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Manage users</a>
                @endif
                <a href="{{ route('settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                <div class="border-t border-gray-100"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="block w-full text-left px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>
</div>
