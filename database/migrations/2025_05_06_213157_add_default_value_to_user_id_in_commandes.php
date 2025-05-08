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
            // Ajouter une valeur par défaut NULL à la colonne user_id
            DB::statement('ALTER TABLE commandes CHANGE user_id user_id BIGINT UNSIGNED NULL DEFAULT NULL');
            
            // Loguer cette opération
            \Log::info('Migration commandes: Valeur par défaut NULL ajoutée à la colonne user_id');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Ne pas annuler cette modification car cela pourrait provoquer des erreurs sur les données existantes
    }
};
