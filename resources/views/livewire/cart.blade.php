<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Shopping Cart</h2>

    @if($cartItems->isEmpty())
        <div class="text-center py-8">
            <p class="text-gray-500 text-lg mb-4">Your cart is empty.</p>
            <a href="/" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md transition-colors">
                Continue Shopping
            </a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="py-4 px-2 text-gray-600 font-semibold">Product</th>
                        <th class="py-4 px-2 text-gray-600 font-semibold">Price</th>
                        <th class="py-4 px-2 text-gray-600 font-semibold">Quantity</th>
                        <th class="py-4 px-2 text-gray-600 font-semibold">Total</th>
                        <th class="py-4 px-2 text-gray-600 font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-4 px-2">
                                <div class="flex items-center space-x-4">
                                    @if($item->image)
                                        <img src="{{ $item->image }}" alt="{{ $item->name }}" class="w-16 h-16 object-cover rounded-md">
                                    @else
                                        <div class="w-16 h-16 bg-gray-200 rounded-md flex items-center justify-center text-gray-400">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $item->name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-2 text-gray-700">${{ number_format($item->price, 2) }}</td>
                            <td class="py-4 px-2">
                                <div class="flex items-center space-x-2">
                                    <button wire:click="updateQuantity({{ $item->id }}, {{ $item->cart_quantity - 1 }})" class="bg-gray-200 hover:bg-gray-300 text-gray-600 w-8 h-8 rounded flex items-center justify-center transition-colors">
                                        -
                                    </button>
                                    <span class="text-gray-800 font-medium w-8 text-center">{{ $item->cart_quantity }}</span>
                                    <button wire:click="updateQuantity({{ $item->id }}, {{ $item->cart_quantity + 1 }})" class="bg-gray-200 hover:bg-gray-300 text-gray-600 w-8 h-8 rounded flex items-center justify-center transition-colors">
                                        +
                                    </button>
                                </div>
                            </td>
                            <td class="py-4 px-2 text-gray-800 font-bold">${{ number_format($item->total_price, 2) }}</td>
                            <td class="py-4 px-2">
                                <button wire:click="remove({{ $item->id }})" class="text-red-500 hover:text-red-700 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-8 flex flex-col md:flex-row justify-between items-center bg-gray-50 p-6 rounded-lg">
            <div class="mb-4 md:mb-0">
                <a href="/" class="text-blue-600 hover:underline flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Continue Shopping
                </a>
            </div>
            <div class="text-right">
                <p class="text-lg text-gray-600 mb-1">Subtotal</p>
                <p class="text-3xl font-bold text-gray-900 mb-4">${{ number_format($total, 2) }}</p>
                <a href="{{ route('checkout.index') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white text-lg px-8 py-3 rounded-md shadow-md transition-colors duration-200">
                    Proceed to Checkout
                </a>
            </div>
        </div>
    @endif
</div>
