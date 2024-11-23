<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;

use App\Http\Controllers\Admin\ContactController;

use App\Http\Controllers\Admin\CouponController;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// مسارات الـ Admin مع التحقق من صلاحيات الدخول
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    // لوحة التحكم الخاصة بالـ Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard'); 

    // إدارة التصنيفات (Categories)
    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::get('/add-category', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/add-category', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/edit-category/{category_id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('update-category/{category_id}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::post('delete-category', [CategoryController::class, 'destroy'])->name('admin.category.delete'); // تم تعديل المسار لحذف التصنيف

    // إدارة المستخدمين (Users)
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('user/{user_id}', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('update-user/{user_id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('delete-user/{user_id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});
// stores
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    // إدارة المتاجر (Stores)
    Route::resource('stores', StoreController::class);  // هذا السطر يقوم بتعريف كافة المسارات الخاصة بالـ Stores
    
    // إذا كنت بحاجة لتعريف مسارات إضافية بشكل فردي (اختياري):
    Route::get('stores', [StoreController::class, 'index'])->name('admin.stores.index');  // عرض قائمة المتاجر
    Route::get('add-store', [StoreController::class, 'create'])->name('admin.stores.create');  // صفحة إضافة متجر جديد
    Route::post('add-store', [StoreController::class, 'store'])->name('admin.stores.store');  // إرسال بيانات المتجر الجديد
    Route::get('edit-store/{store}', [StoreController::class, 'edit'])->name('admin.stores.edit');  // صفحة تعديل متجر
    Route::put('update-store/{store}', [StoreController::class, 'update'])->name('admin.stores.update');  // تحديث المتجر
    Route::delete('stores/{id}', [StoreController::class, 'destroy'])->name('admin.stores.destroy');  // حذف المتجر
});

// products
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);
});

// orders

Route::resource('admin/orders', OrderController::class);
Route::patch('admin/orders/{id}/update-status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
Route::delete('admin/orders/{id}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');
Route::patch('admin/orders/{id}/update-status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
Route::get('admin/orders/status/{status}', [OrderController::class, 'filterByStatus'])->name('admin.orders.filterByStatus');
Route::get('admin/orders/{id}/print', [OrderController::class, 'printOrder'])->name('admin.orders.print');
Route::get('admin/orders/user/{userId}', [OrderController::class, 'userOrders'])->name('admin.orders.userOrders');
Route::get('admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');
Route::get('admin/orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');


// contacts

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
    // Corrected the delete route
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');
});


// كوبونات
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/coupons', [CouponController::class, 'index'])->name('coupons.index');
    Route::get('/coupons/create', [CouponController::class, 'create'])->name('coupons.create');
    Route::post('/coupons', [CouponController::class, 'store'])->name('coupons.store');
    Route::delete('/coupons/{id}', [CouponController::class, 'destroy'])->name('coupons.destroy');
});











