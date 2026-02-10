<div class="font-sans">
    {{-- Breadcrumb --}}
    <nav class="flex text-sm text-gray-500 mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="hover:text-blue-600 transition-colors">Home</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ml-1 font-medium text-gray-700">Shopping Cart</span>
                </div>
            </li>
        </ol>
    </nav>

    <h1 class="text-3xl font-bold text-gray-900 mb-8">Your Shopping Cart</h1>

    @if($cartItems->isEmpty())
        <div class="bg-white rounded-lg shadow-sm p-12 text-center">
            <div class="mx-auto h-24 w-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <h2 class="text-xl font-medium text-gray-900 mb-2">Your cart is empty</h2>
            <p class="text-gray-500 mb-8">Looks like you haven't added any items to your cart yet.</p>
            <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                Start Shopping
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Cart Items --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    {{-- Table Header --}}
                    <div class="hidden md:grid grid-cols-12 gap-4 bg-gray-50 px-6 py-4 border-b border-gray-200 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        <div class="col-span-6">Product</div>
                        <div class="col-span-3 text-center">Quantity</div>
                        <div class="col-span-3 text-right">Subtotal</div>
                    </div>

                    {{-- Table Body --}}
                    <div class="divide-y divide-gray-100">
                        @foreach($cartItems as $item)
                            <div class="p-6 grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
                                {{-- Product --}}
                                <div class="md:col-span-6 flex items-center gap-4">
                                    <div class="h-20 w-20 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                        @if($item->image)
                                            <img src="{{ $item->image }}" alt="{{ $item->name }}" class="h-full w-full object-cover object-center">
                                        @else
                                            <div class="h-full w-full bg-gray-100 flex items-center justify-center text-gray-400">
                                                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="text-base font-semibold text-gray-900">
                                            <a href="{{ route('products.show', $item->id) }}">{{ $item->name }}</a>
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-500">SKU: OMNI-{{ $item->id }}00{{ $item->id }}</p>
                                        {{-- Placeholder for size/variant if available --}}
                                        {{-- <p class="text-sm text-gray-500">Size: One Size</p> --}}
                                        <p class="mt-1 text-sm font-medium text-blue-600">${{ number_format($item->price, 2) }}</p>
                                    </div>
                                </div>

                                {{-- Quantity --}}
                                <div class="md:col-span-3 flex justify-center">
                                    <div class="flex items-center border border-gray-200 rounded-md">
                                        <button wire:click="updateQuantity({{ $item->id }}, {{ $item->cart_quantity - 1 }})" class="p-2 text-gray-600 hover:text-blue-600 hover:bg-gray-50 transition-colors disabled:opacity-50" @if($item->cart_quantity <= 1) disabled @endif>
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                        </button>
                                        <input type="text" readonly value="{{ $item->cart_quantity }}" class="w-10 text-center border-none p-0 text-sm font-semibold text-gray-900 focus:ring-0">
                                        <button wire:click="updateQuantity({{ $item->id }}, {{ $item->cart_quantity + 1 }})" class="p-2 text-gray-600 hover:text-blue-600 hover:bg-gray-50 transition-colors">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                        </button>
                                    </div>
                                </div>

                                {{-- Subtotal & Remove --}}
                                <div class="md:col-span-3 flex items-center justify-between md:justify-end gap-6">
                                    <span class="text-base font-bold text-gray-900">${{ number_format($item->total_price, 2) }}</span>
                                    <button wire:click="remove({{ $item->id }})" class="text-gray-400 hover:text-red-500 transition-colors" title="Remove item">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Bottom Actions --}}
                <div class="mt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <a href="{{ route('products.index') }}" class="flex items-center text-blue-600 hover:text-blue-700 font-medium transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Continue Shopping
                    </a>
                    <button wire:click="$refresh" class="flex items-center text-gray-500 hover:text-gray-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        Update Cart
                    </button>
                </div>
            </div>

            {{-- Order Summary --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-6">Order Summary</h2>

                    {{-- Promo Code --}}
                    <div class="mb-6">
                        <label for="promo" class="block text-sm font-medium text-gray-700 mb-2">Promo Code</label>
                        <div class="flex gap-2">
                            <input type="text" id="promo" placeholder="Enter code" class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm bg-gray-50">
                            <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                Apply
                            </button>
                        </div>
                    </div>

                    {{-- Totals --}}
                    <div class="space-y-4 border-b border-gray-100 pb-6 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span class="font-medium text-gray-900">${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Estimated Shipping</span>
                            <span class="font-medium text-gray-900">{{ $shipping > 0 ? '$'.number_format($shipping, 2) : '$0.00' }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Estimated Tax</span>
                            <span class="font-medium text-gray-900">${{ number_format($tax, 2) }}</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mb-8">
                        <span class="text-lg font-bold text-gray-900">Order Total</span>
                        <span class="text-2xl font-bold text-blue-600">${{ number_format($total, 2) }}</span>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-bold py-3 px-4 rounded-lg shadow-md transition-colors mb-6">
                        Proceed to Checkout
                        <svg class="inline w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>

                    <div class="bg-gray-50 rounded-md p-4 flex items-start gap-3 mb-6">
                        <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        <p class="text-xs text-gray-500">
                            Secure SSL Encrypted Checkout. Your information is 100% safe.
                        </p>
                    </div>

                    <div class="flex justify-center gap-3 text-gray-400">
                        {{-- Placeholder Payment Icons --}}
                        <div class="w-8 h-5 bg-gray-200 rounded"></div>
                        <div class="w-8 h-5 bg-gray-200 rounded"></div>
                        <div class="w-8 h-5 bg-gray-200 rounded"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- You might also like --}}
        <div class="mt-20">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">You might also like</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $product)
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition-shadow group">
                        <div class="relative h-48 bg-gray-100 overflow-hidden">
                            @if($product->image)
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            <button wire:click="addToCartFromRelated({{ $product->id }})" class="absolute bottom-3 right-3 h-10 w-10 bg-white rounded-full shadow-md flex items-center justify-center text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            </button>
                        </div>
                        <div class="p-4">
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">
                                {{-- Category Placeholder --}}
                                PRODUCTS
                            </p>
                            <h3 class="font-bold text-gray-900 mb-2 truncate">
                                <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                            </h3>
                            <p class="text-blue-600 font-bold">${{ number_format($product->price, 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>