<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header / Back to Cart -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900">Checkout</h1>
        <a href="{{ route('cart.index') }}" class="flex items-center text-sm font-medium text-gray-600 hover:text-gray-900">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Cart
        </a>
    </div>

    <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start">
        <!-- Left Column: Forms -->
        <div class="lg:col-span-7">
            <!-- Progress Steps -->
            <div class="flex items-center justify-between mb-10 px-4">
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-blue-600 mt-1">Shipping</span>
                </div>
                <div class="flex-1 h-0.5 bg-blue-600 mx-2"></div>
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 rounded-full border-2 border-blue-600 bg-white flex items-center justify-center text-blue-600 font-bold text-sm">2</div>
                    <span class="text-xs font-semibold text-gray-900 mt-1">Payment</span>
                </div>
                <div class="flex-1 h-0.5 bg-gray-200 mx-2"></div>
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 rounded-full border-2 border-gray-200 bg-white flex items-center justify-center text-gray-400 font-bold text-sm">3</div>
                    <span class="text-xs font-medium text-gray-500 mt-1">Review</span>
                </div>
            </div>

            <form wire:submit.prevent="submit">
                <!-- Shipping Information -->
                <div class="mb-10">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                        </svg>
                        Shipping Information
                    </h2>
                    
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                            <input type="text" id="first_name" wire:model="first_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-3 border" placeholder="John">
                            @error('first_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input type="text" id="last_name" wire:model="last_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-3 border" placeholder="Doe">
                            @error('last_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                            <input type="email" id="email" wire:model="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-3 border" placeholder="john.doe@example.com">
                            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700">Address line 1</label>
                            <input type="text" id="address" wire:model="address" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-3 border" placeholder="123 Modern Avenue">
                            @error('address') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                            <input type="text" id="city" wire:model="city" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-3 border" placeholder="San Francisco">
                            @error('city') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="state" class="block text-sm font-medium text-gray-700">State</label>
                            <select id="state" wire:model="state" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-3 border bg-white">
                                <option value="">Select a state</option>
                                <option value="CA">California</option>
                                <option value="NY">New York</option>
                                <option value="TX">Texas</option>
                                <option value="FL">Florida</option>
                                <option value="IL">Illinois</option>
                            </select>
                            @error('state') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="zip_code" class="block text-sm font-medium text-gray-700">Zip Code</label>
                            <input type="text" id="zip_code" wire:model="zip_code" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-3 border" placeholder="94103">
                            @error('zip_code') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div>
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        Payment Method
                    </h2>

                    <div class="flex space-x-4 mb-8">
                        <button type="button" wire:click="$set('payment_method', 'credit_card')" class="flex-1 py-3 px-4 border rounded-lg flex items-center justify-center font-medium {{ $payment_method === 'credit_card' ? 'border-blue-500 bg-blue-50 text-blue-700 ring-2 ring-blue-500 ring-opacity-50' : 'border-gray-200 bg-white text-gray-600 hover:bg-gray-50' }}">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                            Credit Card
                        </button>
                        <button type="button" wire:click="$set('payment_method', 'paypal')" class="flex-1 py-3 px-4 border rounded-lg flex items-center justify-center font-medium {{ $payment_method === 'paypal' ? 'border-blue-500 bg-blue-50 text-blue-700 ring-2 ring-blue-500 ring-opacity-50' : 'border-gray-200 bg-white text-gray-600 hover:bg-gray-50' }}">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7.076 21.337H2.47a.641.641 0 0 1-.633-.74L4.944.901C5.026.382 5.474 0 5.998 0h7.46c2.57 0 4.578.543 5.69 1.81 1.01 1.15 1.304 2.42 1.012 4.287-.023.143-.047.288-.077.437-.966 5.053-3.066 6.226-5.392 6.226h-1.015a.868.868 0 0 0-.86.94l.234 1.444c.006.04.012.08.016.12l.186 1.158c.056.336-.205.615-.55.615z"/>
                            </svg>
                            PayPal
                        </button>
                    </div>

                    @if($payment_method === 'credit_card')
                        <!-- Credit Card Visual -->
                        <div class="mb-8 max-w-sm mx-auto sm:mx-0">
                            <div class="bg-slate-900 text-white rounded-xl shadow-xl p-6 relative overflow-hidden h-56 w-full">
                                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full bg-white opacity-5"></div>
                                <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-64 h-64 rounded-full bg-white opacity-5"></div>
                                
                                <div class="flex justify-between items-start mb-8">
                                    <div class="w-12 h-8 bg-yellow-400 rounded-md"></div>
                                    <span class="text-xl font-bold italic">VISA</span>
                                </div>
                                
                                <div class="mb-6">
                                    <div class="text-xs text-gray-400 mb-1">Card Number</div>
                                    <div class="text-xl font-mono tracking-widest">{{ $card_number ? chunk_split($card_number, 4, ' ') : '•••• •••• •••• ••••' }}</div>
                                </div>
                                
                                <div class="flex justify-between">
                                    <div>
                                        <div class="text-xs text-gray-400 mb-1">Card Holder</div>
                                        <div class="font-medium tracking-wider uppercase">{{ ($first_name || $last_name) ? ($first_name . ' ' . $last_name) : 'YOUR NAME' }}</div>
                                    </div>
                                    <div>
                                        <div class="text-xs text-gray-400 mb-1">Expires</div>
                                        <div class="font-medium tracking-wider">{{ $card_expiry ?: 'MM/YY' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <label for="card_number" class="block text-sm font-medium text-gray-700">Card Number</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="text" id="card_number" wire:model.live="card_number" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-3 border pr-10" placeholder="0000 0000 0000 0000">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                @error('card_number') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="card_expiry" class="block text-sm font-medium text-gray-700">Expiration Date</label>
                                    <input type="text" id="card_expiry" wire:model.live="card_expiry" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-3 border" placeholder="MM/YY">
                                    @error('card_expiry') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label for="card_cvc" class="block text-sm font-medium text-gray-700">CVV / CVC</label>
                                    <input type="text" id="card_cvc" wire:model="card_cvc" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-3 border" placeholder="123">
                                    @error('card_cvc') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 text-center">
                            <p class="text-gray-600">You will be redirected to PayPal to complete your purchase securely.</p>
                        </div>
                    @endif
                </div>

                <!-- Hidden submit button to allow form submission on enter -->
                <button type="submit" class="hidden"></button>
            </form>
        </div>

        <!-- Right Column: Order Summary -->
        <div class="lg:col-span-5 mt-10 lg:mt-0">
            <div class="bg-white rounded-lg shadow-lg border border-gray-100 overflow-hidden sticky top-6">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Order Summary</h2>

                    <!-- Items -->
                    <div class="space-y-4 mb-6 max-h-96 overflow-y-auto">
                        @foreach($cartItems as $item)
                            <div class="flex items-start space-x-4 py-2">
                                <img src="{{ $item->image }}" alt="{{ $item->name }}" class="h-16 w-16 w-16 flex-none rounded-md object-cover object-center bg-gray-100">
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-sm font-medium text-gray-900 truncate">{{ $item->name }}</h3>
                                    <p class="text-sm text-gray-500">Qty: {{ $item->cart_quantity }}</p>
                                </div>
                                <div class="text-sm font-medium text-gray-900">${{ number_format($item->price * $item->cart_quantity, 2) }}</div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Promo Code -->
                    <div class="flex space-x-2 mb-6">
                        <input type="text" wire:model="promo_code" class="flex-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-2 border" placeholder="Promo code">
                        <button type="button" class="bg-gray-900 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-800">APPLY</button>
                    </div>

                    <!-- Totals -->
                    <div class="border-t border-gray-200 pt-4 space-y-2">
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Subtotal</span>
                            <span>${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Shipping</span>
                            @if($shipping == 0)
                                <span class="text-green-600 font-medium">Free</span>
                            @else
                                <span>${{ number_format($shipping, 2) }}</span>
                            @endif
                        </div>
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Estimated Tax</span>
                            <span>${{ number_format($tax, 2) }}</span>
                        </div>
                        <div class="flex justify-between items-center pt-4 border-t border-gray-200 mt-4">
                            <span class="text-xl font-bold text-gray-900">Total</span>
                            <span class="text-xl font-bold text-blue-600">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <!-- Badges -->
                    <div class="flex justify-center space-x-6 mt-6 pt-6 border-t border-gray-100">
                        <div class="flex items-center text-xs text-gray-500 uppercase tracking-wide">
                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            Secure Payment
                        </div>
                        <div class="flex items-center text-xs text-gray-500 uppercase tracking-wide">
                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            30-Day Returns
                        </div>
                    </div>
                </div>
                
                <div class="p-6 bg-gray-50 border-t border-gray-100">
                    <button wire:click="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-6 rounded-lg shadow-lg transition duration-200 flex items-center justify-center text-lg">
                        Complete Purchase
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="mt-16 border-t border-gray-200 pt-8 pb-4 text-center">
        <div class="flex justify-center space-x-2 text-gray-400 mb-4">
             <svg class="h-6 w-8" fill="currentColor" viewBox="0 0 24 24"><!-- Simple Card Icon --> <rect x="2" y="5" width="20" height="14" rx="2" ry="2" fill="currentColor" opacity="0.2"/> </svg>
             <svg class="h-6 w-8" fill="currentColor" viewBox="0 0 24 24"><!-- Simple Bank Icon --> <path d="M4 10h16v10H4zM2 6h20v2H2z" fill="currentColor" opacity="0.2"/> </svg>
             <svg class="h-6 w-8" fill="currentColor" viewBox="0 0 24 24"><!-- Simple Cart Icon --> <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z" fill="currentColor" opacity="0.2"/> </svg>
        </div>
        <p class="text-sm text-gray-500 flex justify-center items-center">
            <svg class="h-3 w-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
            </svg>
            Encrypted Checkout. Your data is protected by SSL security.
        </p>
        <p class="text-xs text-gray-400 mt-2">© {{ date('Y') }} OMNICORE Retail Group. All rights reserved.</p>
    </div>
</div>
