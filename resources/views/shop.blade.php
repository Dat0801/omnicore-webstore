<x-layouts.app>
    <section class="mx-auto w-full max-w-6xl px-6">
        <div class="relative overflow-hidden rounded-[28px] bg-slate-900">
            <img
                src="https://images.unsplash.com/photo-1481277542470-605612bd2d61?q=80&w=1600&auto=format&fit=crop"
                alt="Workspace with premium tech"
                class="absolute inset-0 h-full w-full object-cover"
            />
            <div class="absolute inset-0 bg-gradient-to-r from-slate-900/90 via-slate-900/60 to-transparent"></div>
            <div class="relative grid gap-10 px-8 py-14 md:grid-cols-2 md:px-12 md:py-16">
                <div class="text-white">
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-sky-300">OmniCore Premium</p>
                    <h1 class="mt-4 text-4xl font-semibold leading-tight md:text-5xl">
                        Upgrade Your <span class="text-sky-300">Lifestyle</span> Today.
                    </h1>
                    <p class="mt-4 max-w-md text-sm text-slate-200 md:text-base">
                        Experience a new standard of quality with curated essentials built for everyday performance and professional tech.
                    </p>
                    <div class="mt-6 flex flex-wrap items-center gap-3">
                        <a
                            href="{{ route('products.index') }}"
                            class="inline-flex items-center justify-center rounded-full bg-blue-600 px-6 py-2 text-sm font-semibold text-white shadow-lg shadow-blue-600/30 transition hover:bg-blue-700"
                        >
                            Explore Collection
                        </a>
                        <a
                            href="#new-arrivals"
                            class="inline-flex items-center justify-center rounded-full border border-white/40 px-6 py-2 text-sm font-semibold text-white transition hover:border-white/70"
                        >
                            Learn More
                        </a>
                    </div>
                </div>
                <div class="hidden items-end justify-end md:flex">
                    <div class="rounded-2xl bg-white/10 p-4 text-white/80 backdrop-blur">
                        <p class="text-xs uppercase tracking-[0.2em]">OmniCore Edit</p>
                        <p class="mt-2 text-lg font-semibold">Minimal desk setup, maximum output.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto mt-10 w-full max-w-6xl px-6">
        <div class="grid gap-4 rounded-2xl bg-white/70 p-6 shadow-sm ring-1 ring-slate-200/70 sm:grid-cols-2 lg:grid-cols-4">
            <div class="flex items-start gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-50 text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.25 12.75 7.5 18l14.25-14.25" />
                    </svg>
                </span>
                <div>
                    <p class="text-sm font-semibold">Free Shipping</p>
                    <p class="text-xs text-slate-500">Orders over $150</p>
                </div>
            </div>
            <div class="flex items-start gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-50 text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6v6l4 2" />
                    </svg>
                </span>
                <div>
                    <p class="text-sm font-semibold">Secure Payment</p>
                    <p class="text-xs text-slate-500">100% encrypted</p>
                </div>
            </div>
            <div class="flex items-start gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-50 text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16.5 9.75 12 14.25 7.5 9.75" />
                    </svg>
                </span>
                <div>
                    <p class="text-sm font-semibold">30 Day Returns</p>
                    <p class="text-xs text-slate-500">No questions asked</p>
                </div>
            </div>
            <div class="flex items-start gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-50 text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18 10.5a6 6 0 1 0-6 6" />
                    </svg>
                </span>
                <div>
                    <p class="text-sm font-semibold">24/7 Support</p>
                    <p class="text-xs text-slate-500">Dedicated assistance</p>
                </div>
            </div>
        </div>
    </section>

    <section id="featured" class="mx-auto mt-12 w-full max-w-6xl px-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-semibold">Featured Products</h2>
                <p class="text-sm text-slate-500">Hand-picked selections for your daily needs.</p>
            </div>
            <a class="text-sm font-semibold text-blue-600 hover:text-blue-700" href="{{ route('products.index') }}">View all</a>
        </div>
        <div class="mt-6">
            <livewire:product-list :sidebar="false" :pagination="false" :limit="4" />
        </div>
    </section>

    <section id="new-arrivals" class="mx-auto mt-14 w-full max-w-6xl px-6">
        <div class="text-center">
            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-blue-500">The Latest Drops</p>
            <h2 class="mt-2 text-2xl font-semibold">New Arrivals</h2>
        </div>

        <div class="mt-8 grid gap-6 md:grid-cols-2">
            <div class="relative overflow-hidden rounded-3xl bg-slate-900 text-white">
                <img
                    src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=1200&auto=format&fit=crop"
                    alt="Mobile collection"
                    class="absolute inset-0 h-full w-full object-cover"
                />
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent"></div>
                <div class="relative p-8">
                    <p class="text-lg font-semibold">The Mobile Collection</p>
                    <p class="mt-2 text-sm text-slate-200">Capture every moment with professional precision and unmatched style.</p>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center mt-5 rounded-full bg-white/90 px-5 py-2 text-sm font-semibold text-slate-900 hover:bg-white">
                        Shop Mobile
                    </a>
                </div>
            </div>
            <div class="relative overflow-hidden rounded-3xl bg-slate-900 text-white">
                <img
                    src="https://images.unsplash.com/photo-1516035069371-29a1b244cc32?q=80&w=1200&auto=format&fit=crop"
                    alt="Professional optics"
                    class="absolute inset-0 h-full w-full object-cover"
                />
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent"></div>
                <div class="relative p-8">
                    <p class="text-lg font-semibold">Professional Optics</p>
                    <p class="mt-2 text-sm text-slate-200">Lenses designed for clarity and artistic expression in any lighting.</p>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center mt-5 rounded-full bg-white/90 px-5 py-2 text-sm font-semibold text-slate-900 hover:bg-white">
                        Explore Gear
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-2xl bg-white p-4 shadow-sm ring-1 ring-slate-200/70">
                <div class="aspect-[4/3] overflow-hidden rounded-xl bg-slate-100">
                    <img src="https://images.unsplash.com/photo-1484704849700-f032a568e944?q=80&w=900&auto=format&fit=crop" alt="Studio speaker" class="h-full w-full object-cover" />
                </div>
                <p class="mt-4 text-sm font-semibold">OmniBuds Pro</p>
                <p class="text-sm text-blue-600">$129.00</p>
            </div>
            <div class="rounded-2xl bg-white p-4 shadow-sm ring-1 ring-slate-200/70">
                <div class="aspect-[4/3] overflow-hidden rounded-xl bg-slate-100">
                    <img src="https://images.unsplash.com/photo-1496181133206-80ce9b88a853?q=80&w=900&auto=format&fit=crop" alt="Laptop" class="h-full w-full object-cover" />
                </div>
                <p class="mt-4 text-sm font-semibold">Vantage Laptop 14"</p>
                <p class="text-sm text-blue-600">$1,299.00</p>
            </div>
            <div class="rounded-2xl bg-white p-4 shadow-sm ring-1 ring-slate-200/70">
                <div class="aspect-[4/3] overflow-hidden rounded-xl bg-slate-100">
                    <img src="https://images.unsplash.com/photo-1512446816042-444d6412677f?q=80&w=900&auto=format&fit=crop" alt="Studio mic" class="h-full w-full object-cover" />
                </div>
                <p class="mt-4 text-sm font-semibold">StudioMic X1</p>
                <p class="text-sm text-blue-600">$89.00</p>
            </div>
            <div class="rounded-2xl bg-white p-4 shadow-sm ring-1 ring-slate-200/70">
                <div class="aspect-[4/3] overflow-hidden rounded-xl bg-slate-100">
                    <img src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8?q=80&w=900&auto=format&fit=crop" alt="Tablet" class="h-full w-full object-cover" />
                </div>
                <p class="mt-4 text-sm font-semibold">NotePad Air 11</p>
                <p class="text-sm text-blue-600">$549.00</p>
            </div>
        </div>
    </section>

    <section class="mx-auto mt-16 w-full max-w-6xl px-6 pb-12">
        <div class="rounded-3xl bg-blue-50/80 px-8 py-10 text-center shadow-sm ring-1 ring-blue-100">
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-blue-600 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 8.25V19.5A2.25 2.25 0 0 1 18.75 21.75H5.25A2.25 2.25 0 0 1 3 19.5V8.25m18 0V6.75A2.25 2.25 0 0 0 18.75 4.5H5.25A2.25 2.25 0 0 0 3 6.75v1.5m18 0-9 6-9-6" />
                </svg>
            </div>
            <h3 class="mt-4 text-xl font-semibold">Join the OMNICORE Community</h3>
            <p class="mt-2 text-sm text-slate-600">Subscribe for early access to product launches, exclusive deals, and tech insights.</p>
            <form class="mx-auto mt-6 flex w-full max-w-md flex-col gap-3 sm:flex-row">
                <input
                    type="email"
                    placeholder="Enter your email address"
                    class="flex-1 rounded-full border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                />
                <button type="submit" class="rounded-full bg-blue-600 px-6 py-2 text-sm font-semibold text-white shadow-lg shadow-blue-600/30 transition hover:bg-blue-700">
                    Subscribe Now
                </button>
            </form>
            <p class="mt-3 text-xs text-slate-400">By subscribing, you agree to our Privacy Policy and Terms of Service.</p>
        </div>
    </section>
</x-layouts.app>
