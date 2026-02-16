<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Breadcrumbs --}}
        <nav class="flex items-center text-sm text-slate-500 mb-8">
            <a href="{{ route('home') }}" class="hover:text-slate-900 transition">Home</a>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <a href="{{ route('products.index') }}" class="hover:text-slate-900 transition">
                {{ $product->category ?? 'Products' }}
            </a>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-slate-900 font-medium">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20">
            {{-- Product Images --}}
            <div class="space-y-6">
                @php
                    $current = $selectedVariant ?? $product;
                @endphp
                <div class="relative aspect-square overflow-hidden rounded-3xl bg-white p-8 border border-slate-100 shadow-sm">
                    <img src="{{ $current->image ?? 'https://via.placeholder.com/600' }}" alt="{{ $current->name }}" class="h-full w-full object-contain object-center">
                    <div class="absolute top-6 left-6">
                         @if($product->badge)
                            <span class="inline-flex items-center rounded-full bg-blue-50 px-3 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">
                                {{ $product->badge }}
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="grid grid-cols-4 gap-4">
                    {{-- Thumbnails (Static for now as model doesn't support multiple images yet) --}}
                    <button class="relative aspect-square overflow-hidden rounded-xl border-2 border-blue-600 bg-white p-2">
                        <img src="{{ $current->image ?? 'https://via.placeholder.com/150' }}" class="h-full w-full object-contain">
                    </button>
                    <button class="relative aspect-square overflow-hidden rounded-xl border border-slate-200 bg-white p-2 hover:border-blue-400 transition">
                         <img src="{{ $current->image ?? 'https://via.placeholder.com/150' }}" class="h-full w-full object-contain opacity-50">
                    </button>
                    <button class="relative aspect-square overflow-hidden rounded-xl border border-slate-200 bg-white p-2 hover:border-blue-400 transition">
                         <img src="{{ $current->image ?? 'https://via.placeholder.com/150' }}" class="h-full w-full object-contain opacity-50">
                    </button>
                    <button class="relative aspect-square overflow-hidden rounded-xl border border-slate-200 bg-white p-2 hover:border-blue-400 transition">
                         <div class="flex h-full w-full items-center justify-center text-xs font-medium text-slate-500">
                             +2
                         </div>
                    </button>
                </div>
            </div>

            {{-- Product Info --}}
            <div>
                <h1 class="text-4xl font-display font-bold text-slate-900 tracking-tight mb-4">{{ $current->name }}</h1>
                
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex items-center text-yellow-400">
                        @for($i = 0; $i < 5; $i++)
                            @if($i < floor($product->rating))
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @else
                                <svg class="h-5 w-5 text-slate-200 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endif
                        @endfor
                        <span class="ml-2 text-sm text-slate-500 font-medium">
                            {{ number_format($product->rating, 1) }} ({{ $product->reviews_count }} reviews)
                        </span>
                    </div>
                    @if($product->is_published)
                        <span class="inline-flex items-center rounded-full bg-emerald-50 px-2 py-1 text-xs font-medium text-emerald-700 ring-1 ring-inset ring-emerald-600/20">In Stock</span>
                    @endif
                </div>

                <div class="flex items-baseline gap-4 mb-8">
                    <span class="text-4xl font-bold text-slate-900">${{ number_format($current->price, 2) }}</span>
                    @if($current->original_price && $current->original_price > $current->price)
                        <span class="text-lg text-slate-400 line-through">${{ number_format($current->original_price, 2) }}</span>
                        <span class="text-sm font-semibold text-rose-500">
                            {{ round((($current->original_price - $current->price) / $current->original_price) * 100) }}% OFF
                        </span>
                    @endif
                </div>

                <div class="prose prose-slate mb-8 text-slate-600">
                    <p>{{ $current->description }}</p>
                </div>

                @if(! empty($availableAttributes))
                    <div class="mb-8 space-y-6">
                        @foreach($availableAttributes as $attributeName => $values)
                            <div>
                                <h3 class="text-sm font-medium text-slate-900 mb-3">
                                    {{ ucfirst($attributeName) }}:
                                    <span class="text-slate-500 font-normal">
                                        {{ $selectedAttributes[$attributeName] ?? $values[0] }}
                                    </span>
                                </h3>
                                <div class="flex flex-wrap items-center gap-3">
                                    @foreach($values as $value)
                                        @php
                                            $isActive = ($selectedAttributes[$attributeName] ?? null) === $value;
                                        @endphp
                                        <button
                                            type="button"
                                            wire:click="selectAttribute('{{ $attributeName }}', '{{ $value }}')"
                                            class="px-3 py-1.5 text-xs font-medium rounded-full border transition
                                                {{ $isActive ? 'border-blue-600 bg-blue-50 text-blue-700' : 'border-slate-200 bg-white text-slate-700 hover:border-blue-300 hover:text-blue-700' }}"
                                        >
                                            {{ $value }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Quantity and Actions --}}
                <div class="flex flex-col sm:flex-row gap-4 mb-10">
                    <div class="flex items-center border border-slate-200 rounded-lg bg-white w-max">
                        <button wire:click="decrementQuantity" class="px-4 py-3 text-slate-600 hover:text-blue-600 transition">-</button>
                        <span class="w-12 text-center font-medium text-slate-900">{{ $quantity }}</span>
                        <button wire:click="incrementQuantity" class="px-4 py-3 text-slate-600 hover:text-blue-600 transition">+</button>
                    </div>

                    <button wire:click="addToCart" class="flex-1 bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-blue-700 transition shadow-lg shadow-blue-600/20 flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        Add to Cart
                    </button>

                    <button class="flex-1 bg-slate-900 text-white font-semibold py-3 px-6 rounded-lg hover:bg-slate-800 transition shadow-lg shadow-slate-900/20">
                        Buy Now
                    </button>
                </div>

                {{-- Value Props --}}
                <div class="grid grid-cols-3 gap-4 py-8 border-t border-slate-100">
                    <div class="text-center">
                        <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-blue-50 text-blue-600 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-slate-900 block">Free Shipping</span>
                    </div>
                    <div class="text-center">
                        <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-blue-50 text-blue-600 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-slate-900 block">2 Year Warranty</span>
                    </div>
                    <div class="text-center">
                        <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-blue-50 text-blue-600 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-slate-900 block">Secure Payment</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabs Section --}}
        <div class="mt-20" x-data="{ activeTab: 'description' }">
            <div class="border-b border-slate-200">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <button
                        type="button"
                        @click="activeTab = 'description'"
                        class="whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium"
                        :class="activeTab === 'description'
                            ? 'border-blue-500 text-blue-600'
                            : 'border-transparent text-slate-500 hover:border-slate-300 hover:text-slate-700'"
                    >
                        Description
                    </button>
                    <button
                        type="button"
                        @click="activeTab = 'specs'"
                        class="whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium"
                        :class="activeTab === 'specs'
                            ? 'border-blue-500 text-blue-600'
                            : 'border-transparent text-slate-500 hover:border-slate-300 hover:text-slate-700'"
                    >
                        Specifications
                    </button>
                    <button
                        type="button"
                        @click="activeTab = 'reviews'"
                        class="whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium"
                        :class="activeTab === 'reviews'
                            ? 'border-blue-500 text-blue-600'
                            : 'border-transparent text-slate-500 hover:border-slate-300 hover:text-slate-700'"
                    >
                        Reviews
                    </button>
                </nav>
            </div>

            <div class="py-8">
                <div x-show="activeTab === 'description'">
                    <div class="grid grid-cols-1 gap-10 lg:grid-cols-2">
                        <div>
                            <h3 class="mb-4 text-lg font-bold text-slate-900">Product Overview</h3>
                            <div class="prose prose-slate text-slate-600">
                                <p>{{ $product->description }}</p>
                            </div>
                        </div>
                        <div class="rounded-2xl bg-slate-50 p-6">
                            <h4 class="text-sm font-semibold text-slate-900">Key Details</h4>
                            <dl class="mt-4 space-y-3 text-sm">
                                @if($product->category)
                                    <div class="flex items-center justify-between">
                                        <dt class="text-slate-500">Category</dt>
                                        <dd class="font-medium text-slate-900">{{ $product->category }}</dd>
                                    </div>
                                @endif
                                <div class="flex items-center justify-between">
                                    <dt class="text-slate-500">Base Price</dt>
                                    <dd class="font-medium text-slate-900">${{ number_format($product->price, 2) }}</dd>
                                </div>
                                @if($product->original_price && $product->original_price > $product->price)
                                    <div class="flex items-center justify-between">
                                        <dt class="text-slate-500">Original Price</dt>
                                        <dd class="font-medium text-slate-900">${{ number_format($product->original_price, 2) }}</dd>
                                    </div>
                                @endif
                                <div class="flex items-center justify-between">
                                    <dt class="text-slate-500">Rating</dt>
                                    <dd class="flex items-center gap-2 font-medium text-slate-900">
                                        <span>{{ number_format($product->rating, 1) }}</span>
                                        <span class="text-xs text-slate-500">({{ $product->reviews_count }} reviews)</span>
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>

                <div x-show="activeTab === 'specs'">
                    <div class="grid grid-cols-1 gap-12 lg:grid-cols-2">
                        <div>
                            <h3 class="mb-6 text-lg font-bold text-slate-900">Technical Specifications</h3>
                            @if(! empty($availableAttributes))
                                <dl class="divide-y divide-slate-100">
                                    @foreach($availableAttributes as $attributeName => $values)
                                        <div class="flex justify-between py-3">
                                            <dt class="text-sm text-slate-500">{{ ucfirst($attributeName) }}</dt>
                                            <dd class="text-sm font-medium text-slate-900">
                                                {{ implode(', ', $values) }}
                                            </dd>
                                        </div>
                                    @endforeach
                                </dl>
                            @else
                                <p class="text-sm text-slate-600">
                                    Detailed specifications for this product are being updated.
                                </p>
                            @endif
                        </div>
                        <div class="flex flex-col items-center justify-center rounded-2xl bg-slate-50 p-8 text-center">
                            <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                                </svg>
                            </div>
                            <h3 class="mb-2 text-lg font-bold text-slate-900">Designed for Everyday Performance</h3>
                            <p class="max-w-xs text-sm text-slate-600">
                                Configuration is synchronized from ERP to keep all technical information accurate and up to date.
                            </p>
                        </div>
                    </div>
                </div>

                <div x-show="activeTab === 'reviews'">
                    <div class="space-y-8">
                        <div class="flex flex-col items-start justify-between gap-4 md:flex-row md:items-center">
                            <div>
                                <h3 class="text-lg font-bold text-slate-900">Customer Reviews</h3>
                                @if($product->reviews_count > 0)
                                    <div class="mt-2 flex items-center gap-2">
                                        <div class="flex items-center text-yellow-400">
                                            @for($i = 0; $i < 5; $i++)
                                                @if($i < floor($product->rating))
                                                    <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                                @else
                                                    <svg class="h-4 w-4 text-slate-200 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                                @endif
                                            @endfor
                                        </div>
                                        <span class="text-sm font-medium text-slate-900">
                                            {{ number_format($product->rating, 1) }} / 5
                                        </span>
                                        <span class="text-xs text-slate-500">
                                            ({{ $product->reviews_count }} reviews)
                                        </span>
                                    </div>
                                @else
                                    <p class="mt-2 text-sm text-slate-500">
                                        There are no reviews for this product yet.
                                    </p>
                                @endif
                            </div>
                            <div>
                                @auth
                                    <button
                                        type="button"
                                        wire:click="toggleReviewForm"
                                        class="inline-flex items-center rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 shadow-sm transition hover:bg-slate-50"
                                    >
                                        {{ $showReviewForm ? 'Close form' : 'Write a review' }}
                                    </button>
                                @else
                                    <a
                                        href="{{ route('login') }}"
                                        class="inline-flex items-center rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 shadow-sm transition hover:bg-slate-50"
                                    >
                                        Sign in to write a review
                                    </a>
                                @endauth
                            </div>
                        </div>

                        @auth
                            @if($showReviewForm)
                                <form wire:submit.prevent="submitReview" class="space-y-4 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                                    <div class="grid gap-4 md:grid-cols-2">
                                        <div>
                                            <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Rating</label>
                                            <select
                                                wire:model.live="reviewRating"
                                                class="mt-1 w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500"
                                            >
                                                @for($i = 5; $i >= 1; $i--)
                                                    <option value="{{ $i }}">{{ $i }} stars</option>
                                                @endfor
                                            </select>
                                            @error('reviewRating')
                                                <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Title (optional)</label>
                                            <input
                                                type="text"
                                                wire:model.live="reviewTitle"
                                                class="mt-1 w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500"
                                                placeholder="E.g. Very satisfied"
                                            />
                                            @error('reviewTitle')
                                                <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div>
                                        <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Review content</label>
                                        <textarea
                                            wire:model.live="reviewBody"
                                            rows="4"
                                            class="mt-1 w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500"
                                            placeholder="Share your real experience with this product..."
                                        ></textarea>
                                        @error('reviewBody')
                                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="flex items-center justify-end gap-3">
                                        <button
                                            type="button"
                                            wire:click="toggleReviewForm"
                                            class="text-sm font-medium text-slate-500 hover:text-slate-700"
                                        >
                                            Cancel
                                        </button>
                                        <button
                                            type="submit"
                                            class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
                                        >
                                            Submit review
                                        </button>
                                    </div>
                                </form>
                            @endif
                        @endauth

                        <div class="space-y-4">
                            @forelse($product->approvedReviews as $review)
                                <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-semibold text-slate-900">
                                                {{ $review->title ?? 'Customer review' }}
                                            </p>
                                            <p class="mt-1 text-xs text-slate-500">
                                                {{ $review->user?->name ?? 'Khách hàng' }} ·
                                                {{ $review->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                        <div class="flex items-center text-yellow-400">
                                            @for($i = 0; $i < 5; $i++)
                                                @if($i < $review->rating)
                                                    <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                                @else
                                                    <svg class="h-4 w-4 text-slate-200 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="mt-3 text-sm text-slate-700">
                                        {{ $review->body }}
                                    </p>
                                </div>
                            @empty
                                @auth
                                    <p class="text-sm text-slate-600">
                                        Be the first to share your experience with this product.
                                    </p>
                                @else
                                    <p class="text-sm text-slate-600">
                                        There are no reviews yet. Sign in to be the first to review.
                                    </p>
                                @endauth
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
