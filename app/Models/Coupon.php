<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    // تحديد الأعمدة القابلة للتعديل
    protected $fillable = [
        'code', 'discount', 'expiry_date', 'is_active',
    ];

    // إذا كنت تستخدم تواريخ مثل expiry_date
    protected $dates = ['expiry_date']; // تحويل هذا الحقل إلى Carbon instance
}
