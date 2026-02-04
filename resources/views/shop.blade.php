<x-layouts.app>
    <div class="flex flex-col lg:flex-row gap-8">
        <div class="w-full lg:w-3/4">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold">Products</h1>
            </div>
            <livewire:product-list />
        </div>
        <div class="w-full lg:w-1/4">
            <livewire:cart />
        </div>
    </div>
</x-layouts.app>
