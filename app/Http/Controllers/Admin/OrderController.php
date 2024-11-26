<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use App\Models\Coupon; // استيراد موديل الكوبونات إذا كنت قد أنشأت موديل للكوبونات

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::paginate(10); // Or whatever pagination logic you are using
        $order = $orders->first(); // Get the first order, or any logic to select an order
    
        return view('admin.orders.index', compact('orders', 'order'));
    }
    

    public function show($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return redirect()->route('admin.orders.index')->with('success', 'Order status updated successfully.');
    }

    public function store(Request $request)
    {
        $order = Order::create([
            'user_id' => $request->user_id,
            'status' => $request->status,
            'total_amount' => 0, // سيتم حسابه لاحقًا
        ]);

        // إضافة العناصر إلى الطلب
        foreach ($request->items as $item) {
            $order->items()->create($item);
        }

        // حساب total_amount
        $total = $order->items->sum(function ($item) {
            return $item->unit_price * $item->quantity;
        });

        // تطبيق الكوبون إذا كان موجودًا
        $discountAmount = 0;
        if ($request->has('coupon_code')) {
            $coupon = Coupon::where('code', $request->coupon_code)->first();
            if ($coupon && $coupon->is_valid) { // تحقق من صلاحية الكوبون
                $discountAmount = $coupon->discount_amount;
            }
        }

        $order->update(['total_amount' => $total - $discountAmount]);

        return redirect()->route('admin.orders.index')->with('success', 'Order created successfully.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully.');
    }

    public function applyCoupon(Request $request)
    {
        // الحصول على الطلب بناءً على ID الطلب
        $order = Order::find($request->order_id);
    
        // التحقق من وجود الكوبون
        $coupon = Coupon::where('code', $request->coupon_code)->first();
    
        if (!$coupon) {
            return redirect()->route('admin.orders.index')->with('error', 'Invalid or expired coupon.');
        }
    
        // التحقق من تاريخ انتهاء صلاحية الكوبون
        // if ($coupon->expires_at && Carbon::parse($coupon->expires_at)->isBefore(Carbon::now())) {
        //     return redirect()->route('admin.orders.index')->with('error', 'Coupon has expired.');
        // }
    
        // الحصول على قيمة الخصم من الكوبون
        $discount = $coupon->discount;
    
        // حساب السعر بعد الخصم
        if ($coupon->discount_type == 'percentage') {
            // إذا كان الخصم نسبة مئوية
            $discountedAmount = $order->total_amount * (1 - ($discount / 100));
        } else {
            // إذا كان الخصم مبلغ ثابت
            $discountedAmount = $order->total_amount - $discount;
        }
    
        // التأكد من أن المبلغ بعد الخصم لا يصبح سالبًا
        $discountedAmount = max(0, $discountedAmount);
    
        // تخزين المبلغ بعد الخصم في العمود discounted_amount
        $order->discounted_amount = $discountedAmount;
    
        // تحديث المجموع الكلي للطلب بعد الخصم
        $order->total_amount = $discountedAmount;
    
        // حفظ التحديثات
        $order->save();
    
        return redirect()->route('admin.orders.index')->with('success', 'Coupon applied successfully!');
    }
                    
}
