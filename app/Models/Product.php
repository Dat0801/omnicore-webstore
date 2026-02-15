<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'erp_product_id',
        'erp_parent_id',
        'name',
        'description',
        'price',
        'original_price',
        'image',
        'category',
        'rating',
        'reviews_count',
        'badge',
        'is_active_in_erp',
        'is_published',
        'has_variants',
        'variant_attributes',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_active_in_erp' => 'boolean',
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'rating' => 'decimal:1',
        'has_variants' => 'boolean',
        'variant_attributes' => 'array',
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->where('is_active_in_erp', true);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'erp_parent_id', 'erp_product_id');
    }

    public function variants(): HasMany
    {
        return $this->hasMany(self::class, 'erp_parent_id', 'erp_product_id')
            ->where('is_published', true)
            ->where('is_active_in_erp', true);
    }
}
