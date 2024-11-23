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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // إذا كان لديك علاقة مع المستخدمين
            $table->string('status')->default('processing'); // حالة الطلب
            $table->decimal('total_amount', 8, 2); // إجمالي المبلغ
            $table->string('payment_method'); // طريقة الدفع
            $table->timestamp('order_date')->useCurrent(); // تاريخ الطلب
            $table->timestamps();
        });
    }
        /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
    
};
