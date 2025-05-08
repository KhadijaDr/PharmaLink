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
        // Solution radicale: supprimer toutes les contraintes et recréer la colonne user_id avec DEFAULT NULL
        
        // 1. D'abord, vérifier si la table existe
        if (Schema::hasTable('commandes')) {
            
            // 2. Puis vérifier si la colonne user_id existe
            if (Schema::hasColumn('commandes', 'user_id')) {
                
                // 3. Identifier et supprimer les contraintes de clé étrangère liées à user_id
                $foreignKeys = DB::select("
                    SELECT CONSTRAINT_NAME
                    FROM information_schema.KEY_COLUMN_USAGE
                    WHERE REFERENCED_TABLE_NAME = 'users'
                    AND TABLE_NAME = 'commandes'
                    AND COLUMN_NAME = 'user_id'
                ");
                
                foreach ($foreignKeys as $key) {
                    DB::statement("ALTER TABLE commandes DROP FOREIGN KEY {$key->CONSTRAINT_NAME}");
                }
                
                // 4. Supprimer la colonne existante
                Schema::table('commandes', function (Blueprint $table) {
                    $table->dropColumn('user_id');
                });
                
                // 5. Attendre un peu pour s'assurer que les changements sont appliqués
                sleep(1);
                
                // 6. Ajouter la nouvelle colonne avec DEFAULT NULL
        Schema::table('commandes', function (Blueprint $table) {
                    $table->unsignedBigInteger('user_id')->nullable()->default(null)->after('id');
        });
                
                // 7. Loguer l'opération
                \Log::info('Migration: Colonne user_id recréée avec DEFAULT NULL');
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Cette migration est irréversible car elle modifie la structure de la base de données de manière définitive
    }
};
