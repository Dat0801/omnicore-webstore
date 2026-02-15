<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OmniCore WebStore</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=space-grotesk:400,500,600,700" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Space Grotesk', 'ui-sans-serif', 'system-ui'],
                        display: ['Space Grotesk', 'ui-sans-serif', 'system-ui'],
                    },
                },
            },
        };
    </script>
    <style>
        :root {
            --omni-ink: #0f172a;
            --omni-muted: #64748b;
            --omni-accent: #2563eb;
            --omni-surface: #f5f7fb;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-14px);
            }
        }

        @keyframes drift {
            0%, 100% {
                transform: translateX(0px) scale(1);
            }
            50% {
                transform: translateX(18px) scale(1.05);
            }
        }
    </style>
    {{-- Alpine.js is included in Livewire --}}
    @livewireStyles
</head>
<body class="min-h-screen bg-[var(--omni-surface)] text-[var(--omni-ink)] font-sans">
    <div class="relative min-h-screen overflow-hidden">
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute -top-24 -left-24 h-72 w-72 rounded-full bg-sky-200/60 blur-3xl motion-safe:animate-[float_9s_ease-in-out_infinite]"></div>
            <div class="absolute top-10 right-10 h-48 w-48 rounded-full bg-emerald-200/60 blur-3xl motion-safe:animate-[drift_12s_ease-in-out_infinite]"></div>
            <div class="absolute bottom-0 left-1/2 h-80 w-80 -translate-x-1/2 rounded-full bg-blue-200/40 blur-3xl"></div>
        </div>

        <div class="relative z-10">
            <nav class="border-b border-white/70 bg-white/70 backdrop-blur">
                <div class="mx-auto flex w-full max-w-6xl items-center justify-between gap-6 px-6 py-5">
                    <div class="flex items-center gap-8">
                        <a href="/" class="flex items-center gap-2">
                            <span class="flex h-9 w-9 items-center justify-center rounded-2xl bg-blue-600 text-white font-semibold">O</span>
                            <span class="text-lg font-semibold tracking-tight">OMNICORE</span>
                        </a>
                        <div class="hidden items-center gap-5 text-sm font-medium text-slate-600 md:flex">
                            @foreach($headerCategories ?? [] as $category)
                                <a
                                    class="hover:text-slate-900"
                                    href="{{ route('products.index', ['selectedCategories' => [$category]]) }}"
                                >
                                    {{ $category }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="hidden flex-1 justify-center lg:flex">
                        <form method="GET" action="{{ route('products.index') }}" class="relative w-full max-w-md">
                            <span class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35m0 0A7.5 7.5 0 1 0 7.5 15.5a7.5 7.5 0 0 0 9.15 1.15Z" />
                                </svg>
                            </span>
                            <input
                                type="search"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Search products..."
                                class="w-full rounded-full border border-slate-200 bg-white/80 px-10 py-2 text-sm text-slate-700 shadow-sm transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                            />
                        </form>
                    </div>

                    <div class="flex items-center gap-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="hidden items-center gap-1 text-sm font-medium text-slate-600 hover:text-slate-900 md:flex">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 7.5a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.118a7.5 7.5 0 0 1 15 0" />
                                </svg>
                                Account
                            </a>
                            <a href="{{ route('admin.orders.index') }}" class="hidden items-center gap-2 rounded-full bg-slate-900 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-slate-800 md:inline-flex">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 7.5h18M3 12h18M3 16.5h18" />
                                </svg>
                                Admin
                            </a>
                        @else
                            <div class="hidden items-center gap-3 text-sm font-medium md:flex">
                                <a href="{{ route('login') }}" class="text-slate-600 hover:text-slate-900">
                                    Sign in
                                </a>
                                <a href="{{ route('register') }}" class="rounded-full bg-slate-900 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-slate-800">
                                    Create account
                                </a>
                            </div>
                        @endauth
                        <button class="hidden h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-600 shadow-sm transition hover:text-slate-900 md:flex" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.598 1.126-4.312 2.733-.714-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </button>
                        <livewire:cart-icon />
                    </div>
                </div>
            </nav>

            <main class="pb-16">
                <div class="mx-auto w-full max-w-6xl px-6 pt-8">
                    @if (session()->has('success'))
                        <div class="mb-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-700">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session()->has('warning'))
                        <div class="mb-4 rounded-xl border border-yellow-200 bg-yellow-50 px-4 py-3 text-yellow-700">
                            {{ session('warning') }}
                        </div>
                    @endif
                </div>

                {{ $slot }}
            </main>

            <footer class="border-t border-slate-200/70 bg-white/70">
                <div class="mx-auto w-full max-w-6xl px-6 py-12">
                    <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-4">
                        <div class="space-y-4">
                            <div class="flex items-center gap-2 text-lg font-semibold">
                                <span class="flex h-9 w-9 items-center justify-center rounded-2xl bg-blue-600 text-white font-semibold">O</span>
                                OMNICORE
                            </div>
                            <p class="text-sm text-slate-600">
                                The ultimate destination for tech enthusiasts and lifestyle minimalists. Curated tools to
                                help you perform and live better.
                            </p>
                            <div class="flex items-center gap-3">
                                <span class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7.5 8.25h9m-9 3.75h6m-6 3.75h3m8.25-8.25a9 9 0 1 1-16.5 5.25" />
                                    </svg>
                                </span>
                                <span class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 19.5 8.25 12l7.5-7.5" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-900">Shop</p>
                            <div class="mt-4 space-y-2 text-sm text-slate-600">
                                <a class="block hover:text-slate-900" href="{{ route('products.index') }}">All Products</a>
                                <a class="block hover:text-slate-900" href="{{ route('products.index') }}">Tech Gadgets</a>
                                <a class="block hover:text-slate-900" href="{{ route('products.index') }}">Lifestyle Gear</a>
                                <a class="block hover:text-slate-900" href="{{ route('products.index') }}">Special Offers</a>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-900">Company</p>
                            <div class="mt-4 space-y-2 text-sm text-slate-600">
                                <a class="block hover:text-slate-900" href="#">About Us</a>
                                <a class="block hover:text-slate-900" href="#">Sustainability</a>
                                <a class="block hover:text-slate-900" href="#">Careers</a>
                                <a class="block hover:text-slate-900" href="#">Press</a>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-900">Support</p>
                            <div class="mt-4 space-y-2 text-sm text-slate-600">
                                <a class="block hover:text-slate-900" href="#">Help Center</a>
                                <a class="block hover:text-slate-900" href="#">Shipping Policy</a>
                                <a class="block hover:text-slate-900" href="#">Returns & Refunds</a>
                                <a class="block hover:text-slate-900" href="#">Contact Us</a>
                            </div>
                        </div>
                    </div>
                    <div class="mt-10 flex flex-col gap-3 border-t border-slate-200/70 pt-6 text-xs text-slate-500 md:flex-row md:items-center md:justify-between">
                        <p>© 2026 OmniCore Global Inc. All rights reserved.</p>
                        <div class="flex items-center gap-4">
                            <a class="hover:text-slate-700" href="#">Privacy Policy</a>
                            <a class="hover:text-slate-700" href="#">Terms of Service</a>
                            <a class="hover:text-slate-700" href="#">Cookie Settings</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    @livewireScripts
</body>
</html>
