<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Client;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::create([
            'name' => 'Camila Silva',
            'email' => 'CamilaS@example.com',
            'phone' => '9873124321',
            'address' => 'Avenue A, 111',
            'photo_path' => 'clientes/perfil.webp'
        ]); 

        Client::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'phone' => '987654321',
            'address' => 'Avenue B, 456',
            'photo_path' => 'clientes/perfil.webp'
        ]); 
    }
}
