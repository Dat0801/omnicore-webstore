<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Customer Information</h2>
        <form wire:submit.prevent="submit">
            <div class="mb-4">
                <label for="customer_name" class="block text-gray-700 font-medium mb-2">Name</label>
                <input type="text" id="customer_name" wire:model="customer_name" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('customer_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="customer_email" class="block text-gray-700 font-medium mb-2">Email</label>
                <input type="email" id="customer_email" wire:model="customer_email" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('customer_email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded transition-colors duration-200 mt-4">
                Place Order
            </button>
        </form>
    </div>

    <div class="bg-gray-50 rounded-lg shadow-md p-6 h-fit">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Order Summary</h2>
        <div class="space-y-4 mb-6">
            @foreach($cartItems as $item)
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <span class="text-gray-600 font-medium">{{ $item->cart_quantity }}x</span>
                        <span class="ml-2 text-gray-800">{{ $item->name }}</span>
                    </div>
                    <span class="text-gray-900 font-semibold">${{ number_format($item->total_price, 2) }}</span>
                </div>
            @endforeach
        </div>
        <div class="border-t border-gray-200 pt-4 flex justify-between items-center">
            <span class="text-xl font-bold text-gray-800">Total</span>
            <span class="text-xl font-bold text-gray-900">${{ number_format($total, 2) }}</span>
        </div>
    </div>
</div>
