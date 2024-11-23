<?php

namespace App\Http\Controllers\Admin; // المسار الصحيح لهذا الملف

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use App\Http\Controllers\Controller; // استدعاء الـ Controller الأساسي

class DashboardController extends Controller
{
    public function index()
    {
        // بطلعلنا الداتا بصفحة الداشبورد
        $stores = Store::count();
        $products = Product::count();
        $orders = Order::count();
        $users = User::where('role_as','0')->count();
        $admins = User::where('role_as','1')->count();
        
        return view('admin.dashboard', compact('stores','users','admins','products','orders')); 

    }
    
}
