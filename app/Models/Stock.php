<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Shop\Entities\ProductAttribute;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stocks';

    protected $fillable = [
        'product_id',
        'product_attribute_id',
        'qty',
        'low_stock_threshold',
    ];

    // Relasi ke model Product (jika ada)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relasi ke model ProductAttribute (jika ada)
    public function productAttribute()
    {
        return $this->belongsTo(ProductAttribute::class);
    }
}
