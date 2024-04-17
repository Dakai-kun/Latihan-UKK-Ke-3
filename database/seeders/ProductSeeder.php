<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'product_name' => 'Batagor',
            'price' => 1000,
            'stock' => 10000
        ]);

        Product::create([
            'product_name' => 'Siomay',
            'price' => 2000,
            'stock' => 10000
        ]);

        Product::create([
            'product_name' => 'Seblak',
            'price' => 1000,
            'stock' => 10000
        ]);
    }
}
