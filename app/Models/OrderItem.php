<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'unit_price', // الحقول المطلوبة
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function product()
{
    return $this->belongsTo(Product::class);
}
// في موديل OrderItem
public function getTotalPriceAttribute()
{
    return $this->unit_price * $this->quantity;
}

}
