<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'shop_order_items'; // Pastikan sesuai nama tabel di database

    protected $fillable = [
        'order_id',
        'product_id',
        'qty',
        'base_price',
        'base_total',
        'tax_amount',
        'tax_percent',
        'discount_amount',
        'discount_percent',
        'sub_total',
        'sku',
        'type',
        'name',
        'attributes',
    ];

    /**
     * Cast attributes
     */
    protected $casts = [
        'attributes' => 'array', // Jika disimpan dalam bentuk JSON
    ];

    /**
     * Relasi ke order
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Relasi ke produk
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
