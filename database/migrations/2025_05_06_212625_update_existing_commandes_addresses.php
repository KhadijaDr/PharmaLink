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
        // Pour toutes les commandes existantes, si address est vide mais adresse a une valeur, copier adresse vers address
        DB::statement('UPDATE commandes SET address = adresse WHERE (address IS NULL OR address = "") AND adresse IS NOT NULL');
        
        // Loguer cette opération
        \Log::info('Migration commandes: Données adresse copiées vers address pour toutes les commandes existantes');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Cette migration ne nécessite pas de down car elle ne fait que copier des données
    }
};
