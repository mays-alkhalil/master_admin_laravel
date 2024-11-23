<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // استيراد الكلاس الأساسي
use App\Models\Order; // استيراد الموديل الصحيح



use Carbon\Carbon;


 
class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();

        // تطبيق البحث بناءً على اسم المستخدم أو الحالة أو طريقة التوصيل
        if ($request->has('search') && $request->search != '') {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            })
            ->orWhere('status', 'like', '%' . $request->search . '%')
            ->orWhere('payment_method', 'like', '%' . $request->search . '%');
        }

        // جلب الطلبات مع الباجيناشن
        $orders = $query->with('user', 'items')->paginate(1);

        return view('admin.orders.index', compact('orders'));
    }
    public function show($id)
    {
        $order = Order::with('items.product')->findOrFail($id); // جلب الطلب مع العناصر والمنتجات المرتبطة
        return view('admin.orders.show', compact('order'));
    }
    
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id); // العثور على الطلب
        $order->update(['status' => $request->status]); // تحديث الحالة

        return redirect()->route('admin.orders.index')->with('success', 'Order status updated successfully.');
    }

    // تحديث total_amount عند إنشاء طلب
public function store(Request $request)
{
    $order = Order::create([
        'user_id' => $request->user_id,
        'status' => $request->status,
        'total_amount' => 0, // سيتم حسابه لاحقًا
    ]);

    // أضف العناصر للطلب
    foreach ($request->items as $item) {
        $order->items()->create($item);
    }

    // حساب total_amount
    $total = $order->items->sum(function ($item) {
        return $item->unit_price * $item->quantity;
    });
    $order->update(['total_amount' => $total]);

    return redirect()->route('admin.orders.index')->with('success', 'Order created successfully.');
}



public function dashboard()
{
    // حساب إجمالي عدد الأوامر
    $ordersCount = \DB::table('orders')
        ->whereDate('created_at', Carbon::today())  // تصفية الأوامر ليوم اليوم
        ->count();  // عدد الأوامر

    // تمرير المتغير للـ View
    return view('admin.dashboard', compact('ordersCount'));
}




}
