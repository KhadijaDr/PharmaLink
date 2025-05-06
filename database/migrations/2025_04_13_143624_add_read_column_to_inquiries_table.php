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
        Schema::table('inquiries', function (Blueprint $table) {
            $table->boolean('read')->default(false)->after('message'); // أو أي مكان مناسب
        });
    }
    
    public function down()
    {
        Schema::table('inquiries', function (Blueprint $table) {
            $table->dropColumn('read');
        });
    }
};
