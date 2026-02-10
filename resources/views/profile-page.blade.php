<x-layouts.app>
    <div class="mx-auto w-full max-w-6xl px-6 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar -->
            <x-account-sidebar active="profile" />

            <!-- Main Content Area -->
            <div class="flex-1">
                <livewire:profile-settings />
            </div>
        </div>
    </div>
</x-layouts.app>
