<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
       use HasApiTokens, HasFactory, Notifiable, UuidTrait;


    protected $table = 'shop_categories';

    protected $fillable = [
        'parent_id',
        'slug',
        'name',
    ];

    /**
     * Relasi ke kategori induk (parent category)
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Relasi ke kategori anak (subcategories)
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function products()
{
    return $this->belongsToMany(Product::class, 'shop_categories_products', 'category_id', 'product_id');
}

}
