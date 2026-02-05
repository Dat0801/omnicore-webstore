<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'erp_product_id',
        'name',
        'description',
        'price',
        'image',
        'is_active_in_erp',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_active_in_erp' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->where('is_active_in_erp', true);
    }
}
