<?php
namespace App\Models;

use App\Models\OrderItem;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'status', 'total_amount', // الحقول التي تريد تعديلها
    ];

   // في موديل Order
public function items()
{
    return $this->hasMany(OrderItem::class);
}

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // في موديل Order
public function getTotalAmountAttribute()
{
    return $this->items->sum(function ($item) {
        return $item->unit_price * $item->quantity;
    });
}

}
