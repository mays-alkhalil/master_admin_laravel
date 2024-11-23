<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    // عرض صفحة الرسائل
    public function index()
    {
        $contacts = Contact::all(); // جلب جميع الرسائل
        return view('admin.contacts.index', compact('contacts'));
    }

    // تخزين الرسالة
    public function store(Request $request)
    {
        // التحقق من المدخلات
        $validated = $request->validate([
            'code' => 'required|unique:coupons,code',
            'discount' => 'required|numeric',
            'expires_at' => 'required|date',
        ]);
    
        // حفظ الكوبون في قاعدة البيانات
        Coupon::create([
            'code' => $validated['code'],
            'discount' => $validated['discount'],
            'expires_at' => $validated['expires_at'],  // التأكد من إرسال expires_at
        ]);
    
        // إعادة التوجيه إلى صفحة عرض الكوبونات مع رسالة نجاح
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon added successfully!');
    }
    
   // Delete a contact message
   public function destroy($id)
   {
       // Find the contact by ID
       $contact = Contact::find($id);

       // If the contact exists, delete it
       if ($contact) {
           $contact->delete();
           return redirect()->route('admin.contacts.index')->with('success', 'Message deleted successfully.');
       }

       // If not found, return with an error message
       return redirect()->route('admin.contacts.index')->with('error', 'Message not found.');
   }
}
