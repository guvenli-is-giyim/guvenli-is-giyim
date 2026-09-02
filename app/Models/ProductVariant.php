<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'color_id',
        'size_id',
        'sku',
        'barcode',
        'stock',
        'price',
        'sale_price',
        'status',
    ];

    protected $casts = [
        'stock' => 'integer',
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'status' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Ürün
    |--------------------------------------------------------------------------
    */

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Renk
    |--------------------------------------------------------------------------
    */

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Beden
    |--------------------------------------------------------------------------
    */

    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class);
    }
}