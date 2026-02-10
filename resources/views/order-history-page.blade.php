<x-layouts.app>
    <div class="mx-auto w-full max-w-6xl px-6 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar -->
            <x-account-sidebar active="orders" />

            <!-- Main Content Area -->
            <livewire:order-history />
        </div>
    </div>
</x-layouts.app>
