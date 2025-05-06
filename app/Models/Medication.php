<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    use HasFactory;
    protected $table= 'medications';

    protected $fillable = ['name', 'description', 'expiry_date', 'supplier', 'quantity', 'price', 'image'];

    // العلاقة بين الأدوية والطلبات
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_medication') // تحديد اسم الجدول الوسيط
                    ->withPivot('quantity');
    }
}