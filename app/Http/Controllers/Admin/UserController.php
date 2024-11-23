<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User; // تأكد من استيراد نموذج User بشكل صحيح

class UserController extends Controller
{
  
  public function index(Request $request)
  {
      $search = $request->input('search');  // الحصول على قيمة البحث

      // استعلام البحث باستخدام `when` لتفعيل البحث حسب الحقول التي يتم إدخالها
      $users = User::when($search, function ($query, $search) {
          return $query->where('name', 'like', '%' . $search . '%')
                       ->orWhere('email', 'like', '%' . $search . '%');
      })
      ->paginate(1);  // يمكنك تعديل 10 حسب عدد العناصر في كل صفحة

      return view('admin.user.index', compact('users'));
  }
}

