<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::all();  // لجلب جميع الكوبونات
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

   // داخل CouponController

   public function store(Request $request)
   {
       // تحقق من صحة البيانات
       $validated = $request->validate([
           'code' => 'required|unique:coupons,code',
           'discount' => 'required|numeric',
           'expires_at' => 'required|date',
       ]);
   
       // إضافة الكوبون
       $coupon = Coupon::create([
           'code' => $validated['code'],
           'discount' => $validated['discount'],
           'expires_at' => $validated['expires_at'],
       ]);
   
       // التوجيه بعد إضافة الكوبون
       return redirect()->route('admin.coupons.index')->with('success', 'Coupon added successfully!');
   }
   

    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon deleted successfully!');
    }
}
