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
        Schema::table('order_items', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();  // أو لا تستخدم nullable حسب الحاجة
            $table->foreign('user_id')->references('id')->on('users');  // إذا كان `user_id` هو مفتاح أجنبي يشير إلى جدول `users`
        });
    }
    
    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
    
};
