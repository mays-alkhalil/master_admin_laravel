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
        Schema::table('stores', function (Blueprint $table) {
            $table->string('image')->nullable(); // إضافة عمود الصورة
        });
    }
    
    public function down()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn('image'); // حذف العمود في حال التراجع
        });
    }
    
};
