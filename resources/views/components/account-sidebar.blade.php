@props(['active' => 'dashboard'])

<aside class="w-full lg:w-64 flex-shrink-0">
    <div class="space-y-8">
        <!-- Main Menu -->
        <div>
            <h3 class="px-4 text-xs font-bold uppercase tracking-wider text-slate-400">Main Menu</h3>
            <nav class="mt-4 space-y-1">
                <a href="{{ route('dashboard') }}" class="group flex items-center gap-3 rounded-lg border-l-4 {{ $active === 'dashboard' ? 'border-blue-600 bg-blue-50 text-blue-700' : 'border-transparent text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} px-4 py-3 text-sm font-medium transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ $active === 'dashboard' ? '' : 'text-slate-400 group-hover:text-slate-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('profile') }}" class="group flex items-center gap-3 rounded-lg border-l-4 {{ $active === 'profile' ? 'border-blue-600 bg-blue-50 text-blue-700' : 'border-transparent text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} px-4 py-3 text-sm font-medium transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ $active === 'profile' ? '' : 'text-slate-400 group-hover:text-slate-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Profile Settings
                </a>
                <a href="{{ route('profile') }}" class="group flex items-center gap-3 rounded-lg border-l-4 {{ $active === 'security' ? 'border-blue-600 bg-blue-50 text-blue-700' : 'border-transparent text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} px-4 py-3 text-sm font-medium transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ $active === 'security' ? '' : 'text-slate-400 group-hover:text-slate-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    Security
                </a>
                <a href="{{ route('orders.index') }}" class="group flex items-center gap-3 rounded-lg border-l-4 {{ $active === 'orders' ? 'border-blue-600 bg-blue-50 text-blue-700' : 'border-transparent text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} px-4 py-3 text-sm font-medium transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ $active === 'orders' ? '' : 'text-slate-400 group-hover:text-slate-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    Orders
                </a>
                <a href="{{ route('profile') }}" class="group flex items-center gap-3 rounded-lg border-l-4 {{ $active === 'addresses' ? 'border-blue-600 bg-blue-50 text-blue-700' : 'border-transparent text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} px-4 py-3 text-sm font-medium transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ $active === 'addresses' ? '' : 'text-slate-400 group-hover:text-slate-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Addresses
                </a>
                <a href="{{ route('profile') }}" class="group flex items-center gap-3 rounded-lg border-l-4 {{ $active === 'payment' ? 'border-blue-600 bg-blue-50 text-blue-700' : 'border-transparent text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} px-4 py-3 text-sm font-medium transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ $active === 'payment' ? '' : 'text-slate-400 group-hover:text-slate-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    Payments
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="group flex w-full items-center gap-3 rounded-lg border-l-4 border-transparent px-4 py-3 text-sm font-medium text-red-600 transition hover:bg-red-50 hover:text-red-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400 group-hover:text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Sign Out
                    </button>
                </form>
            </nav>
        </div>
    </div>
</aside>
