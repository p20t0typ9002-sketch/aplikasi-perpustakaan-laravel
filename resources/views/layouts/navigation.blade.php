<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                    <span class="ml-2 text-sm font-semibold text-gray-700 hidden sm:block">Perpustakaan</span>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 sm:-my-px sm:ms-6 sm:flex items-center">

                    @if(Auth::user()->role === 'admin')
                    {{-- Menu Admin --}}
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        Dashboard
                    </x-nav-link>
                    <x-nav-link :href="route('admin.books.index')" :active="request()->routeIs('admin.books.*')">
                        Kelola Buku
                    </x-nav-link>
                    <x-nav-link :href="route('admin.borrowings.index')" :active="request()->routeIs('admin.borrowings.*')">
                        Peminjaman
                    </x-nav-link>
                    <x-nav-link :href="route('admin.laporan')" :active="request()->routeIs('admin.laporan')">
                        Laporan
                    </x-nav-link>
                    @else
                    {{-- Menu User --}}
                    <x-nav-link :href="route('user.dashboard')" :active="request()->routeIs('user.dashboard')">
                        Dashboard
                    </x-nav-link>
                    <x-nav-link :href="route('user.books')" :active="request()->routeIs('user.books*')">
                        Daftar Buku
                    </x-nav-link>
                    <x-nav-link :href="route('user.riwayat')" :active="request()->routeIs('user.riwayat')">
                        Riwayat
                    </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                {{-- Badge role --}}
                @if(Auth::user()->role === 'admin')
                    <span class="text-xs bg-red-100 text-red-700 px-2 py-0.5 rounded-full font-medium mr-3">Admin</span>
                @else
                    <span class="text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full font-medium mr-3">User</span>
                @endif

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profil
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                Keluar
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if(Auth::user()->role === 'admin')
            <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                Dashboard Admin
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.books.index')" :active="request()->routeIs('admin.books.*')">
                Kelola Buku
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.borrowings.index')" :active="request()->routeIs('admin.borrowings.*')">
                Peminjaman
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.laporan')" :active="request()->routeIs('admin.laporan')">
                Laporan
            </x-responsive-nav-link>
            @else
            <x-responsive-nav-link :href="route('user.dashboard')" :active="request()->routeIs('user.dashboard')">
                Dashboard
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('user.books')" :active="request()->routeIs('user.books*')">
                Daftar Buku
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('user.riwayat')" :active="request()->routeIs('user.riwayat')">
                Riwayat Peminjaman
            </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                <div class="text-xs mt-1 {{ Auth::user()->role === 'admin' ? 'text-red-600' : 'text-blue-600' }}">
                    {{ ucfirst(Auth::user()->role) }}
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    Profil
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        Keluar
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
