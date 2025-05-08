<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Vérifier si la table 'cmd' existe
        if (Schema::hasTable('cmd') && !Schema::hasTable('commandes')) {
            Schema::rename('cmd', 'commandes');
        }
        
        // Ajouter une colonne pharmacist_id à la table commandes si elle manque
        Schema::table('commandes', function (Blueprint $table) {
            if (!Schema::hasColumn('commandes', 'pharmacist_id')) {
                $table->unsignedBigInteger('pharmacist_id')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('commandes') && !Schema::hasTable('cmd')) {
            Schema::rename('commandes', 'cmd');
        }
    }
};
