<?php

namespace App\Console\Commands;

use App\Services\ProductSyncService;
use Illuminate\Console\Command;

class SyncProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync products from OmniCore ERP';

    /**
     * Execute the console command.
     */
    public function handle(ProductSyncService $service)
    {
        $this->info('Starting product sync...');
        
        try {
            $service->syncProducts();
            $this->info('Product sync completed successfully.');
        } catch (\Exception $e) {
            $this->error('Sync failed: ' . $e->getMessage());
        }
    }
}
