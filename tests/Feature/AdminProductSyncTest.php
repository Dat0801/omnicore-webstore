<?php

namespace Tests\Feature;

use App\Livewire\Admin\ProductList as AdminProductList;
use App\Services\ProductSyncService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Mockery;
use Tests\TestCase;

class AdminProductSyncTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_trigger_product_sync_from_erp(): void
    {
        $mockService = Mockery::mock(ProductSyncService::class);
        $mockService->shouldReceive('syncProducts')
            ->once();

        $this->app->instance(ProductSyncService::class, $mockService);

        Livewire::test(AdminProductList::class)
            ->call('syncFromErp');
    }
}
