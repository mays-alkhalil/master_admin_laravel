<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // تطبيق البحث بناءً على اسم المنتج أو الفئة
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhereHas('category', function ($q) use ($request) {
                      $q->where('name', 'like', '%' . $request->search . '%');
                  });
        }

        // جلب المنتجات مع الباجيناشن
        $products = $query->with('category')->paginate(10);

        return view('admin.products.index', compact('products'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $imagePath = $request->file('image') 
            ? $request->file('image')->store('products', 'public') 
            : null;

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all(); // لتحميل جميع الكاتيجوريز
        return view('admin.products.edit', compact('product', 'categories'));
    }
    public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'category_id' => 'required|exists:categories,id',
    ]);

    // التعامل مع الصورة: إذا تم رفع صورة جديدة
    $imagePath = $request->hasFile('image') 
        ? $request->file('image')->store('products', 'public') 
        : $product->image; // إذا لم يتم رفع صورة جديدة، احتفظ بالصورة القديمة

    // تحديث المنتج
    $product->update([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'image' => $imagePath,
        'category_id' => $request->category_id,
    ]);

    return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
}
public function destroy($id)
{
    
    $product = Product::findOrFail($id);

    // حذف الصورة إذا كانت موجودة
    if ($product->image) {
        Storage::disk('public')->delete($product->image);
    }

    // حذف المنتج من قاعدة البيانات
    $product->delete();

    return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
}

    }

