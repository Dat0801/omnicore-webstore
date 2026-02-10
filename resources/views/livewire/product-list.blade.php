<div class="{{ $sidebar ? 'mx-auto w-full max-w-7xl px-6 py-12' : '' }}">
    @if($sidebar)
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">All Products</h1>
        <p class="mt-2 text-slate-500">
            @if($pagination && method_exists($products, 'total'))
                Showing {{ $products->firstItem() }}-{{ $products->lastItem() }} of {{ $products->total() }} results
            @else
                Showing {{ $products->count() }} results
            @endif
        </p>
    </div>
    @endif

    <div class="{{ $sidebar ? 'flex flex-col gap-10 lg:flex-row' : '' }}">
        @if($sidebar)
        <!-- Sidebar -->
        <aside class="w-full shrink-0 space-y-8 lg:w-64">
            <!-- Categories -->
            <div>
                <h3 class="font-semibold text-slate-900 mb-4 uppercase text-xs tracking-wider">Categories</h3>
                <div class="space-y-3">
                    @foreach($categories as $category)
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <div class="relative flex items-center">
                                <input 
                                    type="checkbox" 
                                    wire:model.live="selectedCategories" 
                                    value="{{ $category }}"
                                    class="peer h-5 w-5 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                                >
                            </div>
                            <span class="text-sm text-slate-600 group-hover:text-blue-600 transition">{{ $category }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Price Range -->
            <div>
                <h3 class="font-semibold text-slate-900 mb-4 uppercase text-xs tracking-wider">Price Range</h3>
                <div class="space-y-4">
                    <!-- Simple Range Inputs -->
                    <div class="flex items-center gap-4">
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs">$</span>
                            <input 
                                type="number" 
                                wire:model.live.debounce.500ms="priceMin"
                                class="w-full rounded-lg border-slate-200 py-2 pl-6 pr-2 text-sm focus:border-blue-500 focus:ring-blue-500"
                                placeholder="0"
                            >
                        </div>
                        <span class="text-slate-400">-</span>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs">$</span>
                            <input 
                                type="number" 
                                wire:model.live.debounce.500ms="priceMax"
                                class="w-full rounded-lg border-slate-200 py-2 pl-6 pr-2 text-sm focus:border-blue-500 focus:ring-blue-500"
                                placeholder="3500"
                            >
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between text-xs text-slate-500">
                        <span>${{ number_format($priceMin) }}</span>
                        <span>${{ number_format($priceMax) }}</span>
                    </div>
                    
                    <!-- Visual Slider -->
                    <input 
                        type="range" 
                        min="0" 
                        max="5000" 
                        step="10" 
                        wire:model.live.debounce.200ms="priceMax"
                        class="h-1 w-full cursor-pointer appearance-none rounded-lg bg-slate-200 accent-blue-600"
                    >
                </div>
            </div>

            <!-- Customer Rating -->
            <div>
                <h3 class="font-semibold text-slate-900 mb-4 uppercase text-xs tracking-wider">Customer Rating</h3>
                <div class="space-y-2">
                    @foreach(range(5, 1) as $rating)
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input 
                                type="radio" 
                                wire:model.live="minRating" 
                                value="{{ $rating }}"
                                class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"
                            >
                            <div class="flex items-center text-amber-400">
                                @foreach(range(1, 5) as $i)
                                    @if($i <= $rating)
                                        <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    @else
                                        <svg class="h-4 w-4 text-slate-200 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    @endif
                                @endforeach
                            </div>
                            <span class="text-sm text-slate-600">& up</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Reset Button -->
            <button 
                wire:click="$set('selectedCategories', []); $set('priceMin', 0); $set('priceMax', 3500); $set('minRating', 0);"
                class="w-full rounded-lg bg-slate-100 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-200"
            >
                Reset Filters
            </button>
        </aside>
        @endif

        <!-- Main Content -->
        <div class="flex-1">
            @if($sidebar)
            <!-- Toolbar -->
            <div class="mb-6 flex flex-wrap items-center justify-between gap-4 rounded-xl bg-white p-4 shadow-sm ring-1 ring-slate-200/50">
                <div class="text-sm text-slate-500">
                    Sort by: 
                    <select wire:model.live="sortBy" class="ml-2 rounded-lg border-none bg-slate-50 py-1 pl-3 pr-8 text-sm font-semibold text-slate-700 focus:ring-2 focus:ring-blue-500">
                        <option value="newest">Newest</option>
                        <option value="price_asc">Price: Low to High</option>
                        <option value="price_desc">Price: High to Low</option>
                        <option value="rating">Best Rating</option>
                    </select>
                </div>

                <div class="flex items-center gap-2 rounded-lg bg-slate-100 p-1">
                    <button 
                        wire:click="setViewMode('grid')" 
                        class="rounded p-1.5 transition {{ $viewMode === 'grid' ? 'bg-white shadow text-blue-600' : 'text-slate-500 hover:text-slate-700' }}"
                    >
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                    </button>
                    <button 
                        wire:click="setViewMode('list')" 
                        class="rounded p-1.5 transition {{ $viewMode === 'list' ? 'bg-white shadow text-blue-600' : 'text-slate-500 hover:text-slate-700' }}"
                    >
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
            @endif

            <!-- Product Grid/List -->
            @if($viewMode === 'grid')
                <div class="grid gap-6 sm:grid-cols-2 {{ $sidebar ? 'xl:grid-cols-3' : 'lg:grid-cols-4' }}">
                    @forelse($products as $product)
                        <div class="group relative flex flex-col overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200/70 transition hover:-translate-y-1 hover:shadow-lg">
                            <!-- Image -->
                            <a href="{{ route('products.show', $product) }}" class="relative aspect-square overflow-hidden bg-slate-100 block">
                                @if($product->image)
                                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" />
                                @else
                                    <div class="flex h-full items-center justify-center text-slate-300">
                                        <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                                
                                <!-- Badges -->
                                @if($product->badge)
                                    <span class="absolute left-3 top-3 rounded bg-blue-600 px-2 py-1 text-[10px] font-bold uppercase tracking-wide text-white">
                                        {{ $product->badge }}
                                    </span>
                                @endif
                            </a>

                            <!-- Content -->
                            <div class="flex flex-1 flex-col p-5">
                                <p class="text-xs font-medium uppercase tracking-wider text-slate-500">{{ $product->category ?? 'Uncategorized' }}</p>
                                <h3 class="mt-1 text-base font-bold text-slate-900 line-clamp-1">
                                    <a href="{{ route('products.show', $product) }}" class="hover:text-blue-600 transition">
                                        {{ $product->name }}
                                    </a>
                                </h3>
                                
                                <!-- Rating -->
                                <div class="mt-2 flex items-center gap-1">
                                    <svg class="h-4 w-4 text-amber-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    <span class="text-sm font-semibold text-slate-900">{{ number_format($product->rating, 1) }}</span>
                                    <span class="text-sm text-slate-500">({{ $product->reviews_count }} reviews)</span>
                                </div>

                                <div class="mt-4 flex items-end justify-between">
                                    <div>
                                        <span class="text-xl font-bold text-slate-900">${{ number_format($product->price, 2) }}</span>
                                        @if($product->original_price && $product->original_price > $product->price)
                                            <span class="ml-2 text-sm text-slate-400 line-through">${{ number_format($product->original_price, 2) }}</span>
                                        @endif
                                    </div>
                                    <button 
                                        wire:click="addToCart({{ $product->id }})"
                                        class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-600 text-white transition hover:bg-blue-700 shadow-lg shadow-blue-600/20"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-12 text-center">
                            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <h3 class="mt-4 text-lg font-semibold text-slate-900">No products found</h3>
                            <p class="mt-1 text-slate-500">Try adjusting your filters or search query.</p>
                        </div>
                    @endforelse
                </div>
            @else
                <!-- List View -->
                <div class="space-y-4">
                    @forelse($products as $product)
                        <div class="group flex flex-col overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200/70 transition hover:shadow-lg sm:flex-row">
                            <a href="{{ route('products.show', $product) }}" class="relative w-full shrink-0 sm:w-48 bg-slate-100 block">
                                @if($product->image)
                                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="h-full w-full object-cover" />
                                @else
                                    <div class="flex h-full items-center justify-center text-slate-300">
                                        <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </a>
                            
                            <div class="flex flex-1 flex-col p-6">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-xs font-medium uppercase tracking-wider text-slate-500">{{ $product->category ?? 'Uncategorized' }}</p>
                                        <h3 class="mt-1 text-lg font-bold text-slate-900">
                                            <a href="{{ route('products.show', $product) }}" class="hover:text-blue-600 transition">
                                                {{ $product->name }}
                                            </a>
                                        </h3>
                                        <div class="mt-2 flex items-center gap-1">
                                            <svg class="h-4 w-4 text-amber-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                            <span class="text-sm font-semibold text-slate-900">{{ number_format($product->rating, 1) }}</span>
                                            <span class="text-sm text-slate-500">({{ $product->reviews_count }} reviews)</span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="block text-2xl font-bold text-slate-900">${{ number_format($product->price, 2) }}</span>
                                        @if($product->original_price && $product->original_price > $product->price)
                                            <span class="text-sm text-slate-400 line-through">${{ number_format($product->original_price, 2) }}</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <p class="mt-4 text-sm text-slate-600 line-clamp-2">{{ $product->description }}</p>
                                
                                <div class="mt-6 flex items-center gap-4">
                                    <button 
                                        wire:click="addToCart({{ $product->id }})"
                                        class="inline-flex items-center justify-center rounded-lg bg-slate-900 px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800"
                                    >
                                        Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-12 text-center">
                            <p class="text-slate-500">No products found.</p>
                        </div>
                    @endforelse
                </div>
            @endif

            <!-- Pagination -->
            @if($pagination && method_exists($products, 'links'))
                <div class="mt-10">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
