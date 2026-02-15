<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Breadcrumbs --}}
        <nav class="flex items-center text-sm text-slate-500 mb-8">
            <a href="{{ route('home') }}" class="hover:text-slate-900 transition">Home</a>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <a href="{{ route('products.index') }}" class="hover:text-slate-900 transition">
                {{ $product->category ?? 'Products' }}
            </a>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-slate-900 font-medium">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20">
            {{-- Product Images --}}
            <div class="space-y-6">
                @php
                    $current = $selectedVariant ?? $product;
                @endphp
                <div class="relative aspect-square overflow-hidden rounded-3xl bg-white p-8 border border-slate-100 shadow-sm">
                    <img src="{{ $current->image ?? 'https://via.placeholder.com/600' }}" alt="{{ $current->name }}" class="h-full w-full object-contain object-center">
                    <div class="absolute top-6 left-6">
                         @if($product->badge)
                            <span class="inline-flex items-center rounded-full bg-blue-50 px-3 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">
                                {{ $product->badge }}
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="grid grid-cols-4 gap-4">
                    {{-- Thumbnails (Static for now as model doesn't support multiple images yet) --}}
                    <button class="relative aspect-square overflow-hidden rounded-xl border-2 border-blue-600 bg-white p-2">
                        <img src="{{ $current->image ?? 'https://via.placeholder.com/150' }}" class="h-full w-full object-contain">
                    </button>
                    <button class="relative aspect-square overflow-hidden rounded-xl border border-slate-200 bg-white p-2 hover:border-blue-400 transition">
                         <img src="{{ $current->image ?? 'https://via.placeholder.com/150' }}" class="h-full w-full object-contain opacity-50">
                    </button>
                    <button class="relative aspect-square overflow-hidden rounded-xl border border-slate-200 bg-white p-2 hover:border-blue-400 transition">
                         <img src="{{ $current->image ?? 'https://via.placeholder.com/150' }}" class="h-full w-full object-contain opacity-50">
                    </button>
                    <button class="relative aspect-square overflow-hidden rounded-xl border border-slate-200 bg-white p-2 hover:border-blue-400 transition">
                         <div class="flex h-full w-full items-center justify-center text-xs font-medium text-slate-500">
                             +2
                         </div>
                    </button>
                </div>
            </div>

            {{-- Product Info --}}
            <div>
                <h1 class="text-4xl font-display font-bold text-slate-900 tracking-tight mb-4">{{ $current->name }}</h1>
                
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex items-center text-yellow-400">
                        @for($i = 0; $i < 5; $i++)
                            @if($i < floor($current->rating))
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @else
                                <svg class="h-5 w-5 text-slate-200 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endif
                        @endfor
                        <span class="ml-2 text-sm text-slate-500 font-medium">{{ $current->rating }} ({{ $current->reviews_count }} reviews)</span>
                    </div>
                    @if($product->is_published)
                        <span class="inline-flex items-center rounded-full bg-emerald-50 px-2 py-1 text-xs font-medium text-emerald-700 ring-1 ring-inset ring-emerald-600/20">In Stock</span>
                    @endif
                </div>

                <div class="flex items-baseline gap-4 mb-8">
                    <span class="text-4xl font-bold text-slate-900">${{ number_format($current->price, 2) }}</span>
                    @if($current->original_price && $current->original_price > $current->price)
                        <span class="text-lg text-slate-400 line-through">${{ number_format($current->original_price, 2) }}</span>
                        <span class="text-sm font-semibold text-rose-500">
                            {{ round((($current->original_price - $current->price) / $current->original_price) * 100) }}% OFF
                        </span>
                    @endif
                </div>

                <div class="prose prose-slate mb-8 text-slate-600">
                    <p>{{ $current->description }}</p>
                </div>

                @if(! empty($availableAttributes))
                    <div class="mb-8 space-y-6">
                        @foreach($availableAttributes as $attributeName => $values)
                            <div>
                                <h3 class="text-sm font-medium text-slate-900 mb-3">
                                    {{ ucfirst($attributeName) }}:
                                    <span class="text-slate-500 font-normal">
                                        {{ $selectedAttributes[$attributeName] ?? $values[0] }}
                                    </span>
                                </h3>
                                <div class="flex flex-wrap items-center gap-3">
                                    @foreach($values as $value)
                                        @php
                                            $isActive = ($selectedAttributes[$attributeName] ?? null) === $value;
                                        @endphp
                                        <button
                                            type="button"
                                            wire:click="selectAttribute('{{ $attributeName }}', '{{ $value }}')"
                                            class="px-3 py-1.5 text-xs font-medium rounded-full border transition
                                                {{ $isActive ? 'border-blue-600 bg-blue-50 text-blue-700' : 'border-slate-200 bg-white text-slate-700 hover:border-blue-300 hover:text-blue-700' }}"
                                        >
                                            {{ $value }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Quantity and Actions --}}
                <div class="flex flex-col sm:flex-row gap-4 mb-10">
                    <div class="flex items-center border border-slate-200 rounded-lg bg-white w-max">
                        <button wire:click="decrementQuantity" class="px-4 py-3 text-slate-600 hover:text-blue-600 transition">-</button>
                        <span class="w-12 text-center font-medium text-slate-900">{{ $quantity }}</span>
                        <button wire:click="incrementQuantity" class="px-4 py-3 text-slate-600 hover:text-blue-600 transition">+</button>
                    </div>

                    <button wire:click="addToCart" class="flex-1 bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-blue-700 transition shadow-lg shadow-blue-600/20 flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        Add to Cart
                    </button>

                    <button class="flex-1 bg-slate-900 text-white font-semibold py-3 px-6 rounded-lg hover:bg-slate-800 transition shadow-lg shadow-slate-900/20">
                        Buy Now
                    </button>
                </div>

                {{-- Value Props --}}
                <div class="grid grid-cols-3 gap-4 py-8 border-t border-slate-100">
                    <div class="text-center">
                        <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-blue-50 text-blue-600 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-slate-900 block">Free Shipping</span>
                    </div>
                    <div class="text-center">
                        <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-blue-50 text-blue-600 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-slate-900 block">2 Year Warranty</span>
                    </div>
                    <div class="text-center">
                        <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-blue-50 text-blue-600 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-slate-900 block">Secure Payment</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabs Section --}}
        <div class="mt-20">
            <div class="border-b border-slate-200">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <a href="#" class="border-blue-500 text-blue-600 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium" aria-current="page">Specifications</a>
                    <a href="#" class="border-transparent text-slate-500 hover:border-slate-300 hover:text-slate-700 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium">Description</a>
                    <a href="#" class="border-transparent text-slate-500 hover:border-slate-300 hover:text-slate-700 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium">Compatibility</a>
                </nav>
            </div>
            
            <div class="py-8 grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div>
                    <h3 class="text-lg font-bold text-slate-900 mb-6">Technical Specifications</h3>
                    <dl class="divide-y divide-slate-100">
                        <div class="flex justify-between py-3">
                            <dt class="text-sm text-slate-500">Interface</dt>
                            <dd class="text-sm font-medium text-slate-900">USB-C 3.2 Gen 2</dd>
                        </div>
                        <div class="flex justify-between py-3">
                            <dt class="text-sm text-slate-500">HDMI Output</dt>
                            <dd class="text-sm font-medium text-slate-900">Dual 4K @ 60Hz</dd>
                        </div>
                        <div class="flex justify-between py-3">
                            <dt class="text-sm text-slate-500">Power Delivery</dt>
                            <dd class="text-sm font-medium text-slate-900">Up to 100W Pass-through</dd>
                        </div>
                        <div class="flex justify-between py-3">
                            <dt class="text-sm text-slate-500">Data Transfer</dt>
                            <dd class="text-sm font-medium text-slate-900">10 Gbps (USB 3.1 Gen 2)</dd>
                        </div>
                        <div class="flex justify-between py-3">
                            <dt class="text-sm text-slate-500">Ports</dt>
                            <dd class="text-sm font-medium text-slate-900">2x HDMI, 3x USB-A, 1x USB-C PD, Ethernet, SD/TF</dd>
                        </div>
                    </dl>
                </div>
                <div class="bg-slate-50 rounded-2xl p-8 flex flex-col items-center justify-center text-center">
                    <div class="h-16 w-16 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Omni-Smart Chipset</h3>
                    <p class="text-sm text-slate-600 max-w-xs">Equipped with our proprietary smart management chip that prevents overheating and optimizes power distribution across all connected peripherals.</p>
                </div>
            </div>
        </div>

        {{-- Customer Reviews (Simplified) --}}
        <div class="mt-12 border-t border-slate-200 pt-12">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900">Customer Reviews</h2>
                    <div class="flex items-center gap-2 mt-2">
                         <div class="flex items-center text-yellow-400">
                             {{-- 5 Stars --}}
                            @for($i=0; $i<5; $i++)
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        <span class="font-bold text-slate-900">{{ $product->rating }} out of 5</span>
                    </div>
                </div>
                <button class="border border-slate-300 text-slate-700 font-medium py-2 px-4 rounded-lg hover:bg-slate-50 transition">
                    Write a Review
                </button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold">JD</div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-sm">Jason D.</h4>
                                <span class="text-xs text-emerald-600 font-medium flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    Verified Buyer
                                </span>
                            </div>
                        </div>
                        <span class="text-xs text-slate-400">2 weeks ago</span>
                    </div>
                    <div class="flex text-yellow-400 mb-2">
                        @for($i=0; $i<5; $i++) <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg> @endfor
                    </div>
                    <p class="text-sm text-slate-600 italic">"Solid build quality and the dual HDMI works perfectly with my MacBook Pro setup. No lag at all. Highly recommend for any home office!"</p>
                </div>
                 <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold">SM</div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-sm">Sarah M.</h4>
                                <span class="text-xs text-emerald-600 font-medium flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    Verified Buyer
                                </span>
                            </div>
                        </div>
                        <span class="text-xs text-slate-400">1 month ago</span>
                    </div>
                    <div class="flex text-yellow-400 mb-2">
                        @for($i=0; $i<5; $i++) <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg> @endfor
                    </div>
                    <p class="text-sm text-slate-600 italic">"Fast delivery and beautiful packaging. It gets slightly warm during heavy use but it's much better than my previous plastic hub. Would buy again."</p>
                </div>
            </div>
             <div class="text-center mt-6">
                <button class="text-blue-600 font-medium hover:text-blue-700 text-sm">View all 124 reviews</button>
            </div>
        </div>
    </div>
</div>
