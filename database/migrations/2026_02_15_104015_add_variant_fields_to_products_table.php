<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('erp_parent_id')->nullable()->after('erp_product_id');
            $table->boolean('has_variants')->default(false)->after('is_published');
            $table->json('variant_attributes')->nullable()->after('badge');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'erp_parent_id',
                'has_variants',
                'variant_attributes',
            ]);
        });
    }
};
