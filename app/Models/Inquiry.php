<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'message', 'read'];
    
    protected $casts = [
        'read' => 'boolean',
    ];
    
    protected $attributes = [
        'read' => false,
    ];
}
