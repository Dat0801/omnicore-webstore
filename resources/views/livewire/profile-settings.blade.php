<div class="space-y-6">
    <!-- Header -->
    <div>
        <h2 class="text-2xl font-bold text-slate-900">Account Settings</h2>
        <p class="mt-1 text-sm text-slate-500">Update your personal information and manage your account security.</p>
    </div>
    
    <!-- Success Message -->
    @if (session()->has('success'))
        <div class="rounded-md bg-green-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Personal Information -->
    <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-lg font-medium leading-6 text-slate-900">Personal Information</h3>
        <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
            <!-- Name -->
            <div class="sm:col-span-3">
                <label for="name" class="block text-sm font-medium text-slate-700">Full Name</label>
                <div class="mt-1">
                    <input type="text" wire:model="name" id="name" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                </div>
                @error('name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div class="sm:col-span-3">
                <label for="email" class="block text-sm font-medium text-slate-700">
                    Email Address
                    <span class="ml-2 inline-flex items-center rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800">
                        VERIFIED ACCOUNT
                    </span>
                </label>
                <div class="mt-1">
                    <input type="email" wire:model="email" id="email" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                </div>
                @error('email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Phone -->
            <div class="sm:col-span-3">
                <label for="phone" class="block text-sm font-medium text-slate-700">Phone Number</label>
                <div class="mt-1">
                    <input type="text" wire:model="phone" id="phone" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                </div>
                @error('phone') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Birthday -->
            <div class="sm:col-span-3">
                <label for="birthday" class="block text-sm font-medium text-slate-700">Birthday</label>
                <div class="mt-1">
                    <input type="date" wire:model="birthday" id="birthday" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                </div>
                @error('birthday') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <!-- Security & Password -->
    <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-lg font-medium leading-6 text-slate-900">Security & Password</h3>
        <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
            <!-- Current Password -->
            <div class="sm:col-span-4">
                <label for="current_password" class="block text-sm font-medium text-slate-700">Current Password</label>
                <div class="mt-1">
                    <input type="password" wire:model="current_password" id="current_password" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                </div>
                @error('current_password') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- New Password -->
            <div class="sm:col-span-3">
                <label for="password" class="block text-sm font-medium text-slate-700">New Password</label>
                <div class="mt-1">
                    <input type="password" wire:model="password" id="password" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                </div>
                @error('password') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Confirm Password -->
            <div class="sm:col-span-3">
                <label for="password_confirmation" class="block text-sm font-medium text-slate-700">Confirm New Password</label>
                <div class="mt-1">
                    <input type="password" wire:model="password_confirmation" id="password_confirmation" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                </div>
            </div>
        </div>
    </div>

    <!-- Two-Factor Authentication Banner -->
    <div class="rounded-lg border border-blue-100 bg-blue-50 p-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="rounded-full bg-blue-100 p-2 text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-blue-900">Two-Factor Authentication</h4>
                    <p class="text-sm text-blue-700">Add an extra layer of security to your account.</p>
                </div>
            </div>
            <button type="button" class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-blue-700 shadow-sm ring-1 ring-inset ring-blue-300 hover:bg-blue-50">Enable</button>
        </div>
    </div>

    <!-- Actions -->
    <div class="flex items-center justify-end gap-4 pt-4">
        <button type="button" wire:click="cancel" class="text-sm font-semibold text-slate-900 hover:text-slate-700">Cancel Changes</button>
        <button wire:click="save" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
            Save Changes
        </button>
    </div>
</div>
