<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'description' => 'Ração whiskas',
            'photo_path' => 'images/products/racao_whiskas_gato.webp',
            'purchase_price' => 80.00,
            'sale_price' => 120.00,
            'current_stock' => 50,
            'min_stock' => 10,
        ]);
        
        Product::create([
            'description' => 'Pote de Ração Educativa',
            'photo_path' => 'images/products/pote_racao_educativo.webp',
            'purchase_price' => 15.50,
            'sale_price' => 29.90,
            'current_stock' => 30,
            'min_stock' => 5,
        ]);
        
        Product::create([
            'description' => 'Ração Golden',
            'photo_path' => 'images/products/racao_golden_special_adulto.webp',
            'purchase_price' => 12.75,
            'sale_price' => 22.50,
            'current_stock' => 20,
            'min_stock' => 3,
        ]);
    }
}
