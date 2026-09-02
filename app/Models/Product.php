<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'sku',
        'barcode',
        'short_description',
        'description',
        'price',
        'stock',
        'featured',
        'image',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'featured' => 'boolean',
        'status' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Kategori
    |--------------------------------------------------------------------------
    */

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Marka
    |--------------------------------------------------------------------------
    */

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Renkler
    |--------------------------------------------------------------------------
    */

    public function colors()
    {
        return $this->belongsToMany(
            Color::class,
            'color_product'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Bedenler
    |--------------------------------------------------------------------------
    */

    public function sizes()
    {
        return $this->belongsToMany(
            Size::class,
            'product_size'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Özellikler
    |--------------------------------------------------------------------------
    */

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Ürün Varyantları
    |--------------------------------------------------------------------------
    */

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}