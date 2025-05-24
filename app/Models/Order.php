<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = 'shop_orders'; // Pastikan nama tabel sesuai

    protected $fillable = [
        'user_id',
        'code',
        'status',
        'approved_by',
        'approved_at',
        'cancelled_by',
        'cancelled_at',
        'cancellation_note',
        'order_date',
        'payment_due',
        'payment_url',
        'base_total_price',
        'tax_amount',
        'tax_percent',
        'discount_amount',
        'discount_percent',
        'shipping_cost',
        'grand_total',
        'customer_note',
        'customer_first_name',
        'customer_last_name',
        'customer_address1',
        'customer_address2',
        'customer_phone',
        'customer_email',
        'customer_city',
        'customer_province',
        'customer_postcode',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'order_date' => 'datetime',
        'payment_due' => 'datetime',
        'base_total_price' => 'float',
        'tax_amount' => 'float',
        'tax_percent' => 'float',
        'discount_amount' => 'float',
        'discount_percent' => 'float',
        'shipping_cost' => 'float',
        'grand_total' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function cancelledBy()
    {
        return $this->belongsTo(User::class, 'cancelled_by');
    }
    public function customer()
{
    return $this->belongsTo(User::class, 'user_id');
}

}
