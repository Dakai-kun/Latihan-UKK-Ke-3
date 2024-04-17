<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'user_id',
        'date',
        'price_total'  
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function detail(){
        return $this->hasMany(SalesDetail::class);
    }
}
