<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OmniCore WebStore</title>
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Alpine.js is included in Livewire --}}
    @livewireStyles
</head>
<body class="bg-gray-100 text-gray-900 font-sans">
    <nav class="bg-white shadow p-4 mb-6">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-blue-600">OmniCore WebStore</a>
            <div class="flex items-center space-x-6">
                <a href="/" class="text-gray-600 hover:text-blue-600 font-medium">Home</a>
                <livewire:cart-icon />
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 pb-12">
        @if (session()->has('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if (session()->has('warning'))
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4">
                {{ session('warning') }}
            </div>
        @endif
        
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>
