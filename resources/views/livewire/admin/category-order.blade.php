<div class="space-y-4">
    <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold text-slate-900">Category Ordering</h2>
        <p class="text-xs font-medium text-slate-400">
            Changes are saved automatically when you drop.
        </p>
    </div>

    <div class="mt-2">
        @if(count($orders))
            <div id="category-sortable" class="space-y-2" wire:ignore>
                @foreach($orders as $category)
                    <div
                        class="flex items-center justify-between rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm shadow-sm cursor-move sortable-item"
                        draggable="true"
                        data-name="{{ $category['name'] }}"
                    >
                        <div class="flex items-center gap-3">
                            <span class="text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M7 4h6v2H7V4zm0 5h6v2H7V9zm0 5h6v2H7v-2z" />
                                </svg>
                            </span>
                            <span class="font-medium text-slate-900">
                                {{ $category['name'] }}
                            </span>
                        </div>
                        <div class="flex items-center gap-4">
                            <button
                                type="button"
                                data-toggle-visibility="true"
                                class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-semibold transition
                                    {{ ($category['is_visible'] ?? true) ? 'border-emerald-200 bg-emerald-50 text-emerald-700 hover:bg-emerald-100' : 'border-slate-200 bg-slate-100 text-slate-600 hover:bg-slate-200' }}"
                            >
                                <span class="mr-1.5 h-1.5 w-1.5 rounded-full {{ ($category['is_visible'] ?? true) ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                                <span data-visibility-label>
                                    {{ ($category['is_visible'] ?? true) ? 'Visible on webstore' : 'Hidden on webstore' }}
                                </span>
                            </button>
                            <span class="text-xs text-slate-400">
                                Drag to reorder
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="rounded-lg border border-dashed border-slate-200 bg-slate-50 px-4 py-6 text-center text-sm text-slate-500">
                No categories found. Sync products from ERP first.
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('livewire:initialized', function () {
            var container = document.getElementById('category-sortable');

            if (!container) {
                return;
            }

            var dragEl = null;

            var items = container.querySelectorAll('.sortable-item');

            items.forEach(function (item) {
                var toggleButton = item.querySelector('[data-toggle-visibility]');

                if (toggleButton) {
                    toggleButton.addEventListener('click', function (event) {
                        event.preventDefault();

                        var name = item.dataset.name;
                        var statusDot = toggleButton.querySelector('span');
                        var label = toggleButton.querySelector('[data-visibility-label]');
                        var isCurrentlyVisible = toggleButton.classList.contains('border-emerald-200');

                        if (statusDot) {
                            if (isCurrentlyVisible) {
                                statusDot.classList.remove('bg-emerald-500');
                                statusDot.classList.add('bg-slate-400');
                            } else {
                                statusDot.classList.remove('bg-slate-400');
                                statusDot.classList.add('bg-emerald-500');
                            }
                        }

                        if (isCurrentlyVisible) {
                            toggleButton.classList.remove('border-emerald-200', 'bg-emerald-50', 'text-emerald-700', 'hover:bg-emerald-100');
                            toggleButton.classList.add('border-slate-200', 'bg-slate-100', 'text-slate-600', 'hover:bg-slate-200');

                            if (label) {
                                label.textContent = 'Hidden on webstore';
                            }
                        } else {
                            toggleButton.classList.remove('border-slate-200', 'bg-slate-100', 'text-slate-600', 'hover:bg-slate-200');
                            toggleButton.classList.add('border-emerald-200', 'bg-emerald-50', 'text-emerald-700', 'hover:bg-emerald-100');

                            if (label) {
                                label.textContent = 'Visible on webstore';
                            }
                        }

                        @this.call('toggleVisibility', name);
                    });
                }

                item.addEventListener('dragstart', function (event) {
                    dragEl = item;
                    event.dataTransfer.effectAllowed = 'move';
                    item.classList.add('opacity-50');
                });

                item.addEventListener('dragend', function () {
                    item.classList.remove('opacity-50');
                });

                item.addEventListener('dragover', function (event) {
                    event.preventDefault();

                    var hovering = event.currentTarget;

                    if (hovering === dragEl) {
                        return;
                    }

                    var rect = hovering.getBoundingClientRect();
                    var offset = event.clientY - rect.top;
                    var halfway = rect.height / 2;

                    if (offset > halfway) {
                        hovering.after(dragEl);
                    } else {
                        hovering.before(dragEl);
                    }
                });

                item.addEventListener('drop', function (event) {
                    event.preventDefault();

                    var orderedNames = Array.from(container.querySelectorAll('.sortable-item')).map(function (element) {
                        return element.dataset.name;
                    });

                    @this.call('reorder', orderedNames);
                    @this.call('save');
                });
            });
        });
    </script>
</div>
