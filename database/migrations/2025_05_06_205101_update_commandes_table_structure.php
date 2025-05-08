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
        // Approche plus prudente: créer toutes les colonnes nécessaires d'abord
        Schema::table('commandes', function (Blueprint $table) {
            // S'assurer que la table a toutes les colonnes nécessaires
            if (!Schema::hasColumn('commandes', 'pharmacist_id')) {
                $table->unsignedBigInteger('pharmacist_id')->nullable()->after('id');
            }
            
            if (!Schema::hasColumn('commandes', 'customer_name')) {
                $table->string('customer_name')->nullable();
            }
            
            if (!Schema::hasColumn('commandes', 'phone')) {
                $table->string('phone')->nullable();
            }
            
            if (!Schema::hasColumn('commandes', 'address') && !Schema::hasColumn('commandes', 'adresse')) {
                $table->string('address')->nullable();
            }
            
            if (!Schema::hasColumn('commandes', 'prescription')) {
                $table->string('prescription')->nullable();
            }
            
            if (!Schema::hasColumn('commandes', 'medications')) {
                $table->json('medications')->nullable();
            }
            
            if (!Schema::hasColumn('commandes', 'total_price')) {
                $table->decimal('total_price', 10, 2)->nullable();
            }
            
            if (!Schema::hasColumn('commandes', 'status')) {
                $table->string('status')->default('En attente');
            }
        });
        
        // Essayons de copier les données des anciennes colonnes vers les nouvelles 
        // uniquement si les anciennes colonnes existent
        try {
            if (Schema::hasColumn('commandes', 'nom_client')) {
                DB::statement('UPDATE commandes SET customer_name = nom_client WHERE customer_name IS NULL');
            }
            
            if (Schema::hasColumn('commandes', 'telephone')) {
                DB::statement('UPDATE commandes SET phone = telephone WHERE phone IS NULL');
            }
            
            if (Schema::hasColumn('commandes', 'adresse')) {
                DB::statement('UPDATE commandes SET address = adresse WHERE address IS NULL');
            }
            
            if (Schema::hasColumn('commandes', 'photo_prescription')) {
                DB::statement('UPDATE commandes SET prescription = photo_prescription WHERE prescription IS NULL');
            }
            
            if (Schema::hasColumn('commandes', 'medicaments')) {
                DB::statement('UPDATE commandes SET medications = medicaments WHERE medications IS NULL');
            }
            
            if (Schema::hasColumn('commandes', 'total_prix')) {
                DB::statement('UPDATE commandes SET total_price = total_prix WHERE total_price IS NULL');
            }
        } catch (\Exception $e) {
            // Log l'erreur mais continue la migration
            \Log::error('Erreur lors de la copie des données: ' . $e->getMessage());
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Ne rien faire dans le down pour éviter de perdre des données
    }
};
