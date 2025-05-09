<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductAttributeValue extends Model
{
    use HasFactory;

    protected $table = 'product_attribute_values';

    protected $fillable = [
        'product_id',
        'attribute_id',
        'string_value',
        'text_value',
        'boolean_value',
        'integer_value',
        'float_value',
        'datetime_value',
        'date_value',
        'json_value',
    ];

    protected $casts = [
        'boolean_value' => 'boolean',
        'integer_value' => 'integer',
        'float_value' => 'float',
        'datetime_value' => 'datetime',
        'date_value' => 'date',
        'json_value' => 'array',
    ];

    // Relasi ke produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relasi ke atribut (misalnya ukuran, warna, dll.)
    // public function attribute()
    // {
    //     return $this->belongsTo(Attribute::class);
    // }
}
