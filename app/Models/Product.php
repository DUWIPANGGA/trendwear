<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasApiTokens, HasFactory, Notifiable, UuidTrait;

    protected $table = 'shop_products';

    protected $fillable = [
        'id',	
        'user_id',
        'sku',
        'type',
        'parent_id',
        'name',
        'slug',
        'price',
        'sale_price',
        'status',
        'weight',
        'stock_status',
        'manage_stock',
        'publish_date',
        'excerpt',
        'body',
        'metas',
        'featured_image',
    ];

    protected $casts = [
        'metas' => 'array',
        'publish_date' => 'datetime',
    ];
public function category()
{
    return $this->belongsTo(Category::class, 'category_id');
}

    // Relasi ke user (pemilik produk)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Jika produk ini merupakan varian dari produk induk
    public function parent()
    {
        return $this->belongsTo(Product::class, 'parent_id');
    }

    // Jika produk ini memiliki varian (anak)
    public function variants()
    {
        return $this->hasMany(Product::class, 'parent_id');
    }

    // Relasi ke stok (jika kamu pakai model Stock)
    public function stock()
    {
        return $this->hasOne(Stock::class);
    }
    public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}
}
