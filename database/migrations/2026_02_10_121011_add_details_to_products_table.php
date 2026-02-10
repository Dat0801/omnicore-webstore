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
            $table->string('category')->nullable()->after('description');
            $table->decimal('rating', 3, 1)->default(0)->after('category');
            $table->unsignedInteger('reviews_count')->default(0)->after('rating');
            $table->string('badge')->nullable()->after('reviews_count');
            $table->decimal('original_price', 10, 2)->nullable()->after('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['category', 'rating', 'reviews_count', 'badge', 'original_price']);
        });
    }
};
