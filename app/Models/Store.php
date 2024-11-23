<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'address', 'image', 'owner_id', 'status'];


    // علاقة المتجر مع المستخدم (المالك)
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
