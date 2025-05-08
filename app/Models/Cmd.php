<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cmd extends Model
{
    use HasFactory;

    // Constantes pour les statuts
    const STATUS_PENDING = 'En attente';
    const STATUS_APPROVED = 'Validé';
    const STATUS_REJECTED = 'Refusé';
    
    /**
     * Le nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'commandes';

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_name',
        'phone',
        'address',
        'prescription',
        'medications',
        'total_price',
        'status',
        'pharmacist_id',
        'user_id',
    ];

    /**
     * Les attributs qui doivent être castés.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'medications' => 'json',
        'total_price' => 'decimal:2',
    ];

    /**
     * Valeurs par défaut pour les attributs
     *
     * @var array
     */
    protected $attributes = [
        'status' => 'En attente',
        'user_id' => null,
    ];
    
    /**
     * Relation avec le pharmacien (si applicable)
     */
    public function pharmacist()
    {
        return $this->belongsTo(User::class, 'pharmacist_id');
    }
    
    /**
     * Accesseur pour formater le prix total
     */
    public function getFormattedTotalPriceAttribute()
    {
        return number_format($this->total_price, 2) . ' DH';
    }
} 