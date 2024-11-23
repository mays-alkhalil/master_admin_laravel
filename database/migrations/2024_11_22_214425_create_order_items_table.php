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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // العلاقة مع الطلب
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // العلاقة مع المنتج
            $table->integer('quantity'); // كمية المنتج
            $table->decimal('unit_price', 8, 2); // السعر الفردي للمنتج
            $table->decimal('total_price', 10, 2); // السعر الإجمالي = quantity * unit_price
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};
