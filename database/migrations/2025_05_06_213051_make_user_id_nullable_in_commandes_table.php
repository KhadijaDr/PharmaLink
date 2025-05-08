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
        // Vérifier si la colonne user_id existe
        if (Schema::hasColumn('commandes', 'user_id')) {
            // Modifier la colonne user_id pour la rendre nullable
            DB::statement('ALTER TABLE commandes MODIFY user_id BIGINT UNSIGNED NULL');
            
            // Utiliser le pharmacist_id comme valeur par défaut pour user_id quand c'est possible
            DB::statement('UPDATE commandes SET user_id = pharmacist_id WHERE user_id IS NULL AND pharmacist_id IS NOT NULL');
            
            \Log::info('Migration commandes: Colonne user_id rendue nullable');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // On ne restaure pas la contrainte NOT NULL pour éviter les problèmes de données
    }
};
