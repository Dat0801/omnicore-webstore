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

    public function toggleVisibility(string $name): void
    {
        $this->orders = collect($this->orders)
            ->map(function (array $category) use ($name): array {
                if (($category['name'] ?? null) !== $name) {
                    return $category;
                }

                $category['is_visible'] = ! ($category['is_visible'] ?? true);

                return $category;
            })
            ->all();

        $this->save('Category visibility updated.');
    }

    public function save(string $flashMessage = 'Category order updated.'): void
    {
        foreach ($this->orders as $category) {
            if (! isset($category['name'])) {
                continue;
            }

            $name = $category['name'];
            $sortOrder = $category['sort_order'] ?? null;
            $isVisible = $category['is_visible'] ?? true;

            if ($sortOrder === null || $sortOrder === '') {
                CategoryDisplay::where('name', $name)->delete();

                continue;
            }

            CategoryDisplay::updateOrCreate(
                ['name' => $name],
                [
                    'sort_order' => (int) $sortOrder,
                    'is_visible' => (bool) $isVisible,
                ],
            );
        }

        $this->loadOrders();

        session()->flash('success', $flashMessage);
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
            $isVisible = $existing->has($name) ? (bool) $existing[$name]->is_visible : true;

            return [
                'name' => $name,
                'sort_order' => $sortOrder,
                'is_visible' => $isVisible,
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
