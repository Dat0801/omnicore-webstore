<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OmniCore WebStore Admin</title>
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
                    colors: {
                        omni: {
                            ink: '#0f172a',
                            muted: '#64748b',
                            accent: '#2563eb',
                            surface: '#f8fafc',
                        },
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
            --omni-surface: #f8fafc;
        }
    </style>
    @livewireStyles
</head>
<body class="min-h-screen bg-[var(--omni-surface)] text-[var(--omni-ink)] font-sans">
    <div class="min-h-screen">
        <nav class="border-b border-slate-200 bg-white/90 backdrop-blur">
            <div class="mx-auto flex w-full max-w-6xl items-center justify-between gap-6 px-6 py-4">
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <span class="flex h-9 w-9 items-center justify-center rounded-2xl bg-blue-600 text-white font-semibold">O</span>
                        <span class="text-lg font-semibold tracking-tight">OMNICORE</span>
                    </a>
                    <span class="rounded-full bg-slate-900 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-white">
                        WebStore Admin
                    </span>
                </div>

                <div class="flex items-center gap-4 text-sm font-medium text-slate-600">
                    <a href="{{ route('admin.orders.index') }}" class="hover:text-slate-900">
                        Orders
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="hover:text-slate-900">
                        Products
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="hover:text-slate-900">
                        Categories
                    </a>
                    <a href="{{ route('admin.reviews.index') }}" class="hover:text-slate-900">
                        Reviews
                    </a>
                    <a href="{{ route('dashboard') }}" class="hidden items-center gap-1 rounded-full border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-700 transition hover:bg-slate-50 md:inline-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M5.25 12.75 9 9l3.75 3.75L16.5 9l3.75 3.75" />
                        </svg>
                        Customer View
                    </a>
                </div>
            </div>
        </nav>

        <main class="pb-12 pt-6">
            <div class="mx-auto w-full max-w-6xl px-6">
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

        <footer class="border-t border-slate-200 bg-white/90">
            <div class="mx-auto flex w-full max-w-6xl items-center justify-between gap-4 px-6 py-4 text-xs text-slate-500">
                <p>© 2026 OmniCore WebStore Admin</p>
                <div class="flex items-center gap-3">
                    <span>Internal use only</span>
                </div>
            </div>
        </footer>
    </div>

    @livewireScripts
</body>
</html>
