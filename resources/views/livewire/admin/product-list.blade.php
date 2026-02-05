<div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr class="bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                <th class="px-6 py-3 border-b">Product</th>
                <th class="px-6 py-3 border-b">ERP Status</th>
                <th class="px-6 py-3 border-b">WebStore Status</th>
                <th class="px-6 py-3 border-b">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($products as $product)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            @if($product->image)
                                <img class="h-10 w-10 rounded-full object-cover mr-3" src="{{ $product->image }}" alt="">
                            @else
                                <div class="h-10 w-10 rounded-full bg-gray-200 mr-3"></div>
                            @endif
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                <div class="text-xs text-gray-500">{{ $product->erp_product_id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $product->is_active_in_erp ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $product->is_active_in_erp ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $product->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $product->is_published ? 'Published' : 'Draft' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button wire:click="togglePublish({{ $product->id }})" class="text-indigo-600 hover:text-indigo-900 focus:outline-none">
                            {{ $product->is_published ? 'Unpublish' : 'Publish' }}
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">No products found. Run sync first.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4 px-6">
        {{ $products->links() }}
    </div>
</div>
