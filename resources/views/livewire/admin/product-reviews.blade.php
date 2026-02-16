<div>
    <div class="mb-6 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div class="space-y-1">
            <h2 class="text-xl font-semibold text-slate-900">
                Product Reviews
            </h2>
            <p class="text-sm text-slate-500">
                View, approve or remove customer reviews across all products.
            </p>
        </div>
        <div class="flex flex-col gap-3 md:flex-row md:items-center">
            <div class="flex items-center gap-2">
                <input
                    id="onlyPending"
                    type="checkbox"
                    wire:model.live="onlyPending"
                    class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                >
                <label for="onlyPending" class="text-sm text-slate-700">
                    Only show unapproved
                </label>
            </div>
            <div class="flex items-center gap-2">
                <input
                    type="number"
                    min="1"
                    placeholder="Filter by product ID"
                    wire:model.live="productId"
                    class="w-40 rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500"
                >
            </div>
            <div class="relative">
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search by product, user or text..."
                    class="w-64 rounded-lg border border-slate-200 px-3 py-2 pl-9 text-sm focus:border-blue-500 focus:ring-blue-500"
                >
                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18.5a7.5 7.5 0 006.15-3.85z" />
                    </svg>
                </span>
            </div>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-100 text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                        Product
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                        Rating
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                        Review
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                        Customer
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                        Status
                    </th>
                    <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wide text-slate-500">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($reviews as $review)
                    <tr class="hover:bg-slate-50/60">
                        <td class="px-4 py-3 align-top">
                            @if($review->product)
                                <div class="space-y-0.5">
                                    <div class="flex items-center gap-2">
                                        <a
                                            href="{{ route('admin.products.show', $review->product) }}"
                                            class="font-medium text-slate-900 hover:text-blue-600"
                                        >
                                            {{ $review->product->name }}
                                        </a>
                                    </div>
                                    <p class="text-xs text-slate-500">
                                        ID: {{ $review->product->id }}
                                    </p>
                                </div>
                            @else
                                <span class="text-xs text-slate-400">Product deleted</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 align-top">
                            <div class="flex items-center gap-1 text-yellow-400">
                                @for($i = 0; $i < 5; $i++)
                                    @if($i < $review->rating)
                                        <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    @else
                                        <svg class="h-4 w-4 text-slate-200 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    @endif
                                @endfor
                            </div>
                        </td>
                        <td class="px-4 py-3 align-top">
                            <div class="space-y-1">
                                <p class="font-medium text-slate-900">
                                    {{ $review->title ?? 'Customer review' }}
                                </p>
                                <p class="line-clamp-2 text-xs text-slate-600">
                                    {{ $review->body }}
                                </p>
                                <p class="text-xs text-slate-400">
                                    {{ $review->created_at->format('Y-m-d H:i') }}
                                </p>
                            </div>
                        </td>
                        <td class="px-4 py-3 align-top">
                            <div class="space-y-1">
                                <p class="text-sm font-medium text-slate-900">
                                    {{ $review->user?->name ?? 'Khách hàng' }}
                                </p>
                                @if($review->user?->email)
                                    <p class="text-xs text-slate-500">
                                        {{ $review->user->email }}
                                    </p>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-3 align-top">
                            @if($review->is_approved)
                                <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 ring-1 ring-inset ring-emerald-100">
                                    Approved
                                </span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-amber-50 px-2.5 py-1 text-xs font-medium text-amber-700 ring-1 ring-inset ring-amber-100">
                                    Pending
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 align-top text-right">
                            <div class="flex justify-end gap-2">
                                <button
                                    type="button"
                                    wire:click="toggleApproval({{ $review->id }})"
                                    class="inline-flex items-center rounded-lg border border-slate-200 px-3 py-1.5 text-xs font-medium text-slate-700 transition hover:bg-slate-50"
                                >
                                    {{ $review->is_approved ? 'Unapprove' : 'Approve' }}
                                </button>
                                <button
                                    type="button"
                                    wire:click="deleteReview({{ $review->id }})"
                                    class="inline-flex items-center rounded-lg border border-rose-100 px-3 py-1.5 text-xs font-medium text-rose-700 transition hover:bg-rose-50"
                                >
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-sm text-slate-500">
                            No reviews found matching your filters.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $reviews->links() }}
    </div>
</div>

