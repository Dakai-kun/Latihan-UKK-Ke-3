<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'sale_id',
        'product_id',
        'quantity',
        'subtotal'
    ];
}
