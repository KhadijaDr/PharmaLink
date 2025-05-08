<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            // Vérifier si la colonne address n'existe pas déjà
            if (!Schema::hasColumn('commandes', 'address')) {
                $table->string('address')->nullable()->after('phone');
            }
        });
        
        // Copier les données de adresse vers address
        DB::statement('UPDATE commandes SET address = adresse WHERE address IS NULL AND adresse IS NOT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            if (Schema::hasColumn('commandes', 'address')) {
                $table->dropColumn('address');
            }
        });
    }
};
