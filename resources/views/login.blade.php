<x-layouts.app>
    <div class="mx-auto grid w-full max-w-6xl gap-8 px-6 pb-16 pt-10 lg:grid-cols-[1.05fr_0.95fr]">
        <section class="rounded-[28px] border border-white/60 bg-white/80 p-8 shadow-xl shadow-slate-900/10 backdrop-blur">
            <div class="flex flex-col gap-2">
                <p class="text-sm font-medium uppercase tracking-[0.3em] text-slate-400">Welcome back</p>
                <h1 class="text-3xl font-semibold text-slate-900 md:text-4xl">Log in to keep shopping smarter.</h1>
                <p class="text-sm text-slate-500">Manage orders, track shipments, and keep your store synced in one place.</p>
            </div>

            <form class="mt-8 space-y-5" action="#" method="post">
                @csrf
                <div class="space-y-2">
                    <label class="text-sm font-medium text-slate-600" for="email">Email address</label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        placeholder="name@omnicore.com"
                        class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-sky-400 focus:ring-4 focus:ring-sky-100"
                        autocomplete="email"
                    />
                </div>

                <div class="space-y-2">
                    <div class="flex items-center justify-between text-sm">
                        <label class="font-medium text-slate-600" for="password">Password</label>
                        <a href="#" class="text-sky-600 hover:text-sky-700">Forgot password?</a>
                    </div>
                    <div class="relative">
                        <input
                            id="password"
                            name="password"
                            type="password"
                            placeholder="Enter your password"
                            class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-sky-400 focus:ring-4 focus:ring-sky-100"
                            autocomplete="current-password"
                        />
                        <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600" aria-label="Show password">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12s-3.75 6.75-9.75 6.75S2.25 12 2.25 12Z" />
                                <circle cx="12" cy="12" r="3.25"></circle>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 text-slate-500">
                        <input type="checkbox" class="h-4 w-4 rounded border-slate-300 text-sky-600 focus:ring-sky-200" />
                        Keep me logged in
                    </label>
                </div>

                <button type="submit" class="w-full rounded-2xl bg-slate-900 py-3 text-sm font-semibold text-white shadow-lg shadow-slate-900/20 transition hover:-translate-y-0.5 hover:bg-slate-800 motion-reduce:transition-none">
                    Login
                </button>

                <div class="flex items-center gap-4 text-xs text-slate-400">
                    <span class="h-px flex-1 bg-slate-200"></span>
                    OR CONTINUE WITH
                    <span class="h-px flex-1 bg-slate-200"></span>
                </div>

                <div class="grid gap-3 sm:grid-cols-2">
                    <button type="button" class="flex items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white py-2.5 text-sm font-medium text-slate-700 shadow-sm transition hover:border-slate-300">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-slate-50">
                            <svg viewBox="0 0 48 48" class="h-4 w-4" aria-hidden="true">
                                <path fill="#EA4335" d="M24 9.5c3.2 0 6.1 1.1 8.4 3.2l6.3-6.3C34.9 2.3 29.8 0 24 0 14.6 0 6.5 5.3 2.4 13l7.4 5.7C11.5 13.1 17.3 9.5 24 9.5Z"/>
                                <path fill="#34A853" d="M46.5 24.5c0-1.5-.2-2.9-.5-4.3H24v8.1h12.6c-.6 3.2-2.4 5.9-5.2 7.7l7.9 6.1c4.6-4.2 7.2-10.4 7.2-17.6Z"/>
                                <path fill="#4A90E2" d="M9.8 28.1a14.6 14.6 0 0 1 0-9.3l-7.4-5.7a24 24 0 0 0 0 20.7l7.4-5.7Z"/>
                                <path fill="#FBBC05" d="M24 48c6.5 0 12-2.1 16-5.7l-7.9-6.1c-2.2 1.5-5 2.4-8.1 2.4-6.7 0-12.5-3.6-14.2-9l-7.4 5.7C6.5 42.7 14.6 48 24 48Z"/>
                            </svg>
                        </span>
                        Google
                    </button>
                    <button type="button" class="flex items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white py-2.5 text-sm font-medium text-slate-700 shadow-sm transition hover:border-slate-300">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-slate-50">
                            <svg viewBox="0 0 24 24" class="h-4 w-4" aria-hidden="true">
                                <path fill="currentColor" d="M16.4 12.6c0-2.4 2-3.6 2.1-3.7-1.2-1.7-3.1-1.9-3.8-1.9-1.6-.2-3.1.9-3.9.9-.8 0-2-.9-3.3-.9-1.7 0-3.3 1-4.1 2.6-1.8 3.1-.5 7.8 1.3 10.3.9 1.2 1.9 2.5 3.3 2.5 1.3 0 1.8-.8 3.4-.8 1.6 0 2 .8 3.3.8 1.4 0 2.3-1.2 3.2-2.4 1-1.5 1.4-3 1.4-3.1-.1 0-2.8-1.1-2.8-4.3ZM14.8 5.2c.7-.9 1.2-2.2 1.1-3.5-1 .1-2.3.7-3 1.6-.7.8-1.3 2.1-1.1 3.4 1.1.1 2.3-.6 3-1.5Z"/>
                            </svg>
                        </span>
                        Apple
                    </button>
                </div>
            </form>

            <p class="mt-6 text-center text-sm text-slate-500">
                Need an account?
                <a href="{{ route('register') }}" class="font-medium text-slate-900 hover:text-slate-700">Create one</a>
            </p>
        </section>

        <aside class="flex flex-col justify-between rounded-[28px] bg-slate-900 p-8 text-white shadow-2xl shadow-slate-900/30">
            <div class="space-y-6">
                <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-xs uppercase tracking-[0.35em]">OmniCore Secure</div>
                <h2 class="text-2xl font-semibold">The fastest way to manage webstore ops.</h2>
                <p class="text-sm text-slate-200">
                    Monitor order status, track inventory sync, and keep your customers updated in real time.
                </p>

                <div class="grid gap-3">
                    <div class="flex items-start gap-3 rounded-2xl bg-white/10 p-4">
                        <div class="mt-1 h-8 w-8 rounded-full bg-sky-400/30"></div>
                        <div>
                            <p class="text-sm font-semibold">Smart order routing</p>
                            <p class="text-xs text-slate-200">Route orders instantly to ERP and delivery partners.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 rounded-2xl bg-white/10 p-4">
                        <div class="mt-1 h-8 w-8 rounded-full bg-emerald-400/30"></div>
                        <div>
                            <p class="text-sm font-semibold">Real-time inventory</p>
                            <p class="text-xs text-slate-200">Keep stock levels updated across storefronts.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl border border-white/10 bg-white/5 p-6">
                <p class="text-sm font-medium">Secure, encrypted checkout & account protection.</p>
                <p class="mt-2 text-xs text-slate-300">Compliant with modern security standards and multi-factor ready.</p>
            </div>
        </aside>
    </div>
</x-layouts.app>
