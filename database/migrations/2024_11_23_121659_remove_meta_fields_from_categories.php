<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveMetaFieldsFromCategories extends Migration
{
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            if (Schema::hasColumn('categories', 'slug')) {
                $table->dropColumn('slug');
            }
            if (Schema::hasColumn('categories', 'meta_title')) {
                $table->dropColumn('meta_title');
            }
            if (Schema::hasColumn('categories', 'meta_description')) {
                $table->dropColumn('meta_description');
            }
            if (Schema::hasColumn('categories', 'meta_keywords')) {
                $table->dropColumn('meta_keywords');
            }
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('slug')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
        });
    }
}
