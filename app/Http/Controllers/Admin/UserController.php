<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User; // تأكد من استيراد نموذج User بشكل صحيح

class UserController extends Controller
{
    // دالة عرض المستخدمين
    public function index(Request $request)
    {
        $search = $request->input('search');  // الحصول على قيمة البحث

        // استعلام البحث باستخدام `when` لتفعيل البحث حسب الحقول التي يتم إدخالها
        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                         ->orWhere('email', 'like', '%' . $search . '%');
        })
        ->paginate(1);  // يمكنك تعديل 1 حسب عدد العناصر في كل صفحة

        return view('admin.user.index', compact('users'));
    }

    // دالة تحرير المستخدم
    public function edit($id)
    {
        // جلب المستخدم بناءً على الـ ID
        $user = User::findOrFail($id);
        
        // تمرير المستخدم إلى صفحة التحرير
        return view('admin.user.edit', compact('user'));
    }

    // دالة تحديث المستخدم
    public function update(Request $request, $id)
    {
        // التحقق من صحة البيانات المدخلة
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // جلب المستخدم
        $user = User::findOrFail($id);

        // تحديث البيانات
        $user->update($request->all());

        // إعادة توجيه إلى صفحة عرض المستخدمين مع رسالة نجاح
        return redirect()->route('admin.users.index')->with('message', 'User updated successfully.');
    }
}
