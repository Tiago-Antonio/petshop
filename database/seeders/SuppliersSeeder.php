<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SuppliersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::create([
            'name' => 'Fornecedor A',
            'email' => 'fornecedorA@example.com',
            'phone' => '9876543210',
            'address' => 'Rua X, 123',
        ]);
        
        Supplier::create([
            'name' => 'Fornecedor B',
            'email' => 'fornecedorB@example.com',
            'phone' => '9876549870',
            'address' => 'Rua Y, 456',
        ]);
        
    }
}
