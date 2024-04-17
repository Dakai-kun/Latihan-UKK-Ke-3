<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
      'product_name',
      'price',
      'stock'  
    ];

    public function detail(){
        return $this->hasMany(SalesDetail::class);
    }
}
