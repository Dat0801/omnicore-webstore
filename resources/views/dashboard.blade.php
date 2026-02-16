<x-layouts.app>
    <div class="mx-auto w-full max-w-6xl px-6 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar -->
            <x-account-sidebar active="dashboard" />

            <!-- Main Content Area -->
            <div class="flex-1 space-y-8">
                <!-- Header Section -->
                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-slate-900">Welcome back, Alex!</h1>
                        <p class="mt-1 flex items-center gap-2 text-sm text-slate-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>
                                You have <span class="font-medium text-blue-600">1 order</span> currently in transit. Expected delivery: Tuesday, Oct 24.
                            </span>
                        </p>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('orders.index') }}" class="flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-blue-700 whitespace-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Track Active Order
                        </a>
                        <a href="{{ route('products.index') }}" class="rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 shadow-sm transition hover:bg-slate-50 whitespace-nowrap">
                            Shop New
                        </a>
                    </div>
                </div>

                <!-- Stats Grid -->
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    <!-- Stat Card 1 -->
                    <div class="rounded-xl border border-slate-100 bg-white p-6 shadow-sm">
                        <div class="flex items-start justify-between">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-50 text-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            </div>
                            <span class="rounded-full bg-green-50 px-2 py-0.5 text-xs font-medium text-green-700">+2 this month</span>
                        </div>
                        <div class="mt-4">
                            <p class="text-sm font-medium text-slate-500">Total Orders</p>
                            <p class="mt-1 text-2xl font-bold text-slate-900">42</p>
                        </div>
                    </div>

                    <!-- Stat Card 2 -->
                    <div class="rounded-xl border border-slate-100 bg-white p-6 shadow-sm">
                        <div class="flex items-start justify-between">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-purple-50 text-purple-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                                </svg>
                            </div>
                            <span class="rounded-full bg-purple-50 px-2 py-0.5 text-xs font-medium text-purple-700">Gold Member</span>
                        </div>
                        <div class="mt-4">
                            <p class="text-sm font-medium text-slate-500">Rewards Points</p>
                            <p class="mt-1 text-2xl font-bold text-slate-900">1,250</p>
                        </div>
                    </div>

                    <!-- Stat Card 3 -->
                    <div class="rounded-xl border border-slate-100 bg-white p-6 shadow-sm">
                        <div class="flex items-start justify-between">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-50 text-orange-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                            </div>
                            <span class="rounded-full bg-slate-100 px-2 py-0.5 text-xs font-medium text-slate-600">Since 2021</span>
                        </div>
                        <div class="mt-4">
                            <p class="text-sm font-medium text-slate-500">Total Lifetime Spend</p>
                            <p class="mt-1 text-2xl font-bold text-slate-900">$3,842.00</p>
                        </div>
                    </div>

                    <!-- Stat Card 4 -->
                    <div class="rounded-xl border border-slate-100 bg-white p-6 shadow-sm">
                        <div class="flex items-start justify-between">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-green-50 text-green-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4">
                            <p class="text-sm font-medium text-slate-500">Tickets Raised</p>
                            <p class="mt-1 text-2xl font-bold text-slate-900">0</p>
                        </div>
                    </div>
                </div>

                <!-- Split Content: Orders vs Widgets -->
                <div class="grid gap-8 lg:grid-cols-3">
                    <!-- Left Column (2/3 width) -->
                    <div class="space-y-8 lg:col-span-2">
                        <!-- Recent Orders -->
                        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">
                            <div class="flex items-center justify-between border-b border-slate-100 px-6 py-4">
                                <h3 class="font-semibold text-slate-900">Recent Orders</h3>
                                <a href="{{ route('orders.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700">View All</a>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left text-sm">
                                    <thead>
                                        <tr class="border-b border-slate-100 bg-slate-50/50 text-xs font-semibold uppercase tracking-wide text-slate-500">
                                            <th class="px-6 py-3">Order ID</th>
                                            <th class="px-6 py-3">Date</th>
                                            <th class="px-6 py-3">Status</th>
                                            <th class="px-6 py-3 text-right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100">
                                        <tr>
                                            <td class="px-6 py-4 font-medium text-slate-900">#OM-98231</td>
                                            <td class="px-6 py-4 text-slate-500">Oct 18, 2023</td>
                                            <td class="px-6 py-4">
                                                <span class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-medium text-blue-700">
                                                    <span class="mr-1.5 h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                                                    In Transit
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-right font-medium text-slate-900">$249.99</td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 font-medium text-slate-900">#OM-97552</td>
                                            <td class="px-6 py-4 text-slate-500">Oct 12, 2023</td>
                                            <td class="px-6 py-4">
                                                <span class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-medium text-green-700">
                                                    <span class="mr-1.5 h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                                    Delivered
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-right font-medium text-slate-900">$89.50</td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 font-medium text-slate-900">#OM-97401</td>
                                            <td class="px-6 py-4 text-slate-500">Sep 28, 2023</td>
                                            <td class="px-6 py-4">
                                                <span class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-medium text-green-700">
                                                    <span class="mr-1.5 h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                                    Delivered
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-right font-medium text-slate-900">$1,120.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Frequently Reordered -->
                        <div>
                            <h3 class="mb-4 font-semibold text-slate-900">Frequently Reordered</h3>
                            <div class="grid gap-4 sm:grid-cols-2">
                                <!-- Product 1 -->
                                <div class="flex items-center gap-4 rounded-xl border border-slate-200 bg-white p-4 shadow-sm transition hover:shadow-md">
                                    <div class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-lg bg-slate-100">
                                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&q=80&w=200" alt="Shoe" class="h-full w-full object-cover">
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-sm font-medium text-slate-900">OMNI-Sprint Elite X</h4>
                                        <p class="mt-1 text-sm text-slate-500">$120.00</p>
                                    </div>
                                    <button class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-50 text-blue-600 transition hover:bg-blue-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </button>
                                </div>
                                
                                <!-- Product 2 -->
                                <div class="flex items-center gap-4 rounded-xl border border-slate-200 bg-white p-4 shadow-sm transition hover:shadow-md">
                                    <div class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-lg bg-slate-100">
                                        <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&q=80&w=200" alt="Headphones" class="h-full w-full object-cover">
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-sm font-medium text-slate-900">Aero Buds Pro</h4>
                                        <p class="mt-1 text-sm text-slate-500">$89.00</p>
                                    </div>
                                    <button class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-50 text-blue-600 transition hover:bg-blue-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column (1/3 width) -->
                    <div class="space-y-6 lg:col-span-1">
                        <!-- Default Shipping -->
                        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                            <div class="flex items-center justify-between">
                                <h3 class="font-semibold text-slate-900">Default Shipping</h3>
                                <a href="{{ route('profile') }}" class="text-xs font-medium text-blue-600 hover:text-blue-700">Edit</a>
                            </div>
                            <div class="mt-4 flex items-start gap-3">
                                <div class="mt-0.5 flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-slate-100 text-slate-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </div>
                                <div class="text-sm text-slate-600">
                                    <p class="font-medium text-slate-900">Home (Primary)</p>
                                    <p class="mt-1">1245 Innovation Blvd, Suite 300</p>
                                    <p>San Francisco, CA 94105</p>
                                    <p>United States</p>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                            <div class="flex items-center justify-between">
                                <h3 class="font-semibold text-slate-900">Payment Method</h3>
                                <a href="{{ route('profile') }}" class="text-xs font-medium text-blue-600 hover:text-blue-700">Edit</a>
                            </div>
                            <div class="mt-4 flex items-center gap-3">
                                <div class="flex h-8 w-12 flex-shrink-0 items-center justify-center rounded bg-slate-900 text-white">
                                    <span class="text-[10px] font-bold tracking-wider">VISA</span>
                                </div>
                                <div class="text-sm text-slate-600">
                                    <p class="font-medium text-slate-900">Visa ending in 4242</p>
                                    <p class="text-xs">Expires 12/26</p>
                                </div>
                            </div>
                        </div>

                        <!-- Premier Card -->
                        <div class="relative overflow-hidden rounded-xl bg-gradient-to-br from-blue-600 to-blue-500 p-6 text-white shadow-lg">
                            <div class="absolute -right-6 -top-6 h-24 w-24 rounded-full bg-white/10 blur-xl"></div>
                            <div class="absolute -bottom-6 -left-6 h-24 w-24 rounded-full bg-white/10 blur-xl"></div>
                            
                            <div class="relative">
                                <p class="text-[10px] font-bold uppercase tracking-widest text-blue-100">Omnicore Premier</p>
                                <div class="mt-4">
                                    <h3 class="text-lg font-bold">Alex Johnson</h3>
                                    <p class="text-xs text-blue-100">Tier Status: GOLD</p>
                                </div>
                                <div class="mt-6 flex items-end justify-between">
                                    <div>
                                        <p class="text-[10px] text-blue-200">Member ID</p>
                                        <p class="font-mono text-sm tracking-widest">882-901-44</p>
                                    </div>
                                    <div class="h-8 w-8 bg-white/20 p-0.5">
                                        <!-- Fake QR -->
                                        <div class="h-full w-full bg-white/90"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-xl border border-dashed border-slate-300 bg-slate-50 p-6 text-center">
                            <p class="text-sm font-medium text-slate-900">Need help with an order?</p>
                            <a href="mailto:support@omnicore.test" class="mt-3 inline-flex items-center gap-1 text-sm font-semibold text-blue-600 hover:text-blue-700">
                                Contact Support
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
