<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\CategoryFormRequest;

class CategoryController extends Controller
{
    public function products()
{
    return $this->hasMany(Product::class);
}

public function index(Request $request)
{
    $search = $request->input('search');  // الحصول على قيمة البحث إن وُجدت

    // استخدام paginate مع دعم البحث إذا كان هناك
    $categories = Category::when($search, function ($query, $search) {
        return $query->where('name', 'like', '%' . $search . '%');
    })
    ->paginate(1);  // يمكن تغيير 10 إلى العدد الذي تريده لكل صفحة

    return view('admin.category.index', compact('categories'));
}
    public function create(){
        return view('admin.category.create'); // عرض الصفحة المرتبطة
    }

    public function store(CategoryFormRequest $request){
       $data = $request->validated();
       $category = new Category;
       $category->name=$data['name'];
       $category->description=$data['description'];

       if($request->hasfile('image')){
         $file = $request->file('image');
         $filename = time(). '.'. $file->getClientOriginalExtension();
         $file->move('uploads/categories', $filename);
         $category->image=$filename;

       }
       $category->created_by = Auth::user()->id;
       $category->save();
       return redirect()->route('admin.category')->with('message', 'Category Added Successfully');

        // return view('admin.category.create'); // عرض الصفحة المرتبطة
    }

    public function edit($category_id){
        $category = Category::find($category_id);
        return view('admin.category.edit', compact('category')); 
    }


    public function update(CategoryFormRequest $request, $category_id){

       
            $data = $request->validated();
            $category = Category::find($category_id);
            $category->name=$data['name'];
            $category->description=$data['description'];
     
            if($request->hasfile('image')){
        $destination = 'uploads/category/' . $category->image;
        if(File::exists($destination)){
            File::delete($destination);  // حذف الصورة القديمة التي كانت موجودة في المجلد uploads/categories/
        }
              $file = $request->file('image');
              $filename = time(). '.'. $file->getClientOriginalExtension();
              $file->move('uploads/categories', $filename);
              $category->image=$filename;
     
            }
            $category->created_by = Auth::user()->id;
            $category->update();
            return redirect()->route('admin.category')->with('message', 'Category updated Successfully');
     
             // return view('admin.category.create'); // عرض الصفحة المرتبطة
        
     
    }

    public function destroy(Request $request){
        $category = Category::find($request->category_delete_id);
        if($category){
            $destination = 'uploads/categories/'. $category->image;
            if(File::exists($destination)){
                File::delete($destination);  // حذف الصورة التي كانت موجودة في المجلد uploads/categories/
            }
            $category->delete();
            return redirect()->route('admin.category')->with('message', 'Category deleted Successfully');
    
        }else{
            return redirect()->route('admin.category')->with('message', 'No Category Id Found');
        }
    }
}