<?php

use Livewire\Component;
use App\Models\CategoryDisplay;
use App\Models\Product;

new class extends Component
{
    public array $orders = [];

    public function mount(): void
    {
        $this->loadOrders();
    }

    public function reorder(array $orderedNames): void
    {
        $existing = collect($this->orders)->keyBy('name');

        $this->orders = collect($orderedNames)
            ->filter(fn ($name) => $existing->has($name))
            ->values()
            ->map(function (string $name, int $index) use ($existing): array {
                $item = $existing[$name];
                $item['sort_order'] = $index + 1;

                return $item;
            })
            ->all();
    }

    public function save(): void
    {
        foreach ($this->orders as $category) {
            if (! isset($category['name'])) {
                continue;
            }

            $name = $category['name'];
            $sortOrder = $category['sort_order'] ?? null;

            if ($sortOrder === null || $sortOrder === '') {
                CategoryDisplay::where('name', $name)->delete();

                continue;
            }

            CategoryDisplay::updateOrCreate(
                ['name' => $name],
                ['sort_order' => (int) $sortOrder],
            );
        }

        $this->loadOrders();

        session()->flash('success', 'Category order updated.');
    }

    public function render()
    {
        return view('livewire.admin.category-order');
    }

    protected function loadOrders(): void
    {
        $categoryNames = Product::query()
            ->select('category')
            ->whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category')
            ->all();

        $existing = CategoryDisplay::query()
            ->whereIn('name', $categoryNames)
            ->get()
            ->keyBy('name');

        $orders = collect($categoryNames)->map(function (string $name) use ($existing): array {
            $sortOrder = $existing->has($name) ? $existing[$name]->sort_order : null;

            return [
                'name' => $name,
                'sort_order' => $sortOrder,
            ];
        });

        $this->orders = $orders
            ->sortBy(function (array $category): int {
                return $category['sort_order'] ?? 9999;
            })
            ->values()
            ->all();
    }
};
?>

<div>
</div>
