<x-layouts.app>
    <div class="mx-auto w-full max-w-6xl px-6 py-8">
        <div class="flex flex-col gap-8 lg:flex-row">
            <x-account-sidebar active="orders" />

            <div class="flex-1">
                <livewire:order-detail :order="$order" />
            </div>
        </div>
    </div>
</x-layouts.app>

