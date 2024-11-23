<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // اسم المتجر
            $table->foreignId('owner_id')->nullable()->constrained('users')->onDelete('cascade');  // ربط المتجر بالمستخدم (المالك)
            $table->text('description')->nullable();  // وصف المتجر
            $table->string('address')->nullable();  // عنوان المتجر
            $table->enum('status', ['active', 'inactive'])->default('active');  // حالة المتجر
            $table->string('meta_title')->nullable(); // أضف العمود
    
            $table->timestamps();  // تواريخ الإنشاء والتحديث
        });
    }
        
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
