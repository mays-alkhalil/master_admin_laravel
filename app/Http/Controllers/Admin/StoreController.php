<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    // عرض جميع المتاجر
    public function index(Request $request)
    {
        // الحصول على قيمة البحث من الـ query string
        $search = $request->input('search');

        // استعلام البيانات مع الباجيناشن (pagination) والبحث
        $stores = Store::when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%')
                             ->orWhere('address', 'like', '%' . $search . '%');  // يمكنك إضافة شروط أخرى للبحث مثل العنوان
            })
            ->paginate(1); // عدد المتاجر في الصفحة

        // تمرير المتاجر المصفاة إلى الـ View
        return view('admin.stores.index', compact('stores'));
    }
    // عرض صفحة إضافة متجر جديد
    public function create()
    {
        return view('admin.stores.create');
    }

    // إضافة متجر جديد
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $request->file('image') 
            ? $request->file('image')->store('stores', 'public') 
            : null;

            Store::create([
                'name' => $request->name,
                'owner_id' => auth()->id(), // تأكد من أن auth()->id() تُرجع قيمة
                'description' => $request->description,
                'address' => $request->address,
                'image' => $imagePath,
            ]);
            

        return redirect()->route('admin.stores.index')->with('success', 'Store created successfully.');
    }

    // عرض صفحة تعديل متجر
    public function edit($id)
    {
        $store = Store::findOrFail($id);
        return view('admin.stores.edit', compact('store'));
    }

    // تحديث بيانات المتجر
    public function update(Request $request, $store_id)
    {
        // البحث عن المتجر باستخدام المعرف
        $store = Store::findOrFail($store_id);

        // التحقق من البيانات المدخلة
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // التعامل مع الصورة: إذا تم رفع صورة جديدة، قم بتخزينها
        $imagePath = $request->hasFile('image') 
            ? $request->file('image')->store('stores', 'public') 
            : $store->image; // إذا لم يتم رفع صورة جديدة، احتفظ بالصورة القديمة

        // تحديث بيانات المتجر
        $store->update([
            'name' => $request->name,
            'description' => $request->description,
            'address' => $request->address,
            'image' => $imagePath,
            'status' => $request->has('status') ? 'active' : 'inactive',  // تعديل هنا
        ]);
        
        return redirect()->route('admin.stores.index')->with('success', 'Store updated successfully.');
    }

    // حذف متجر
    public function destroy($store_id)
    {
        $store = Store::findOrFail($store_id);

        // حذف صورة المتجر إذا كانت موجودة
        if ($store->image) {
            Storage::disk('public')->delete($store->image);
        }

        $store->delete();

        return redirect()->route('admin.stores.index')->with('success', 'Store deleted successfully.');
    }
}
