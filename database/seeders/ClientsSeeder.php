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

        Client::create([
            'name' => 'Lucas Pereira',
            'email' => 'lucas.pereira@example.com',
            'phone' => '991234567',
            'address' => 'Rua das Flores, 123',
            'photo_path' => 'clientes/perfil.webp'
        ]);

        Client::create([
            'name' => 'Ana Beatriz Costa',
            'email' => 'ana.costa@example.com',
            'phone' => '992345678',
            'address' => 'Av. Central, 890',
            'photo_path' => 'clientes/perfil.webp'
        ]);

        Client::create([
            'name' => 'Marcos Souza',
            'email' => 'marcos.souza@example.com',
            'phone' => '993456789',
            'address' => 'Rua Brasil, 345',
            'photo_path' => 'clientes/perfil.webp'
        ]);

        Client::create([
            'name' => 'Fernanda Lima',
            'email' => 'fernanda.lima@example.com',
            'phone' => '994567890',
            'address' => 'Av. Paulista, 1000',
            'photo_path' => 'clientes/perfil.webp'
        ]);

        Client::create([
            'name' => 'Bruno Carvalho',
            'email' => 'bruno.carvalho@example.com',
            'phone' => '995678901',
            'address' => 'Rua Amazonas, 78',
            'photo_path' => 'clientes/perfil.webp'
        ]);

        Client::create([
            'name' => 'Juliana Rocha',
            'email' => 'juliana.rocha@example.com',
            'phone' => '996789012',
            'address' => 'Travessa São Jorge, 55',
            'photo_path' => 'clientes/perfil.webp'
        ]);

        Client::create([
            'name' => 'Eduardo Almeida',
            'email' => 'eduardo.almeida@example.com',
            'phone' => '997890123',
            'address' => 'Alameda Santos, 321',
            'photo_path' => 'clientes/perfil.webp'
        ]);

        Client::create([
            'name' => 'Patrícia Mello',
            'email' => 'patricia.mello@example.com',
            'phone' => '998901234',
            'address' => 'Rua das Acácias, 200',
            'photo_path' => 'clientes/perfil.webp'
        ]);

        Client::create([
            'name' => 'Thiago Nunes',
            'email' => 'thiago.nunes@example.com',
            'phone' => '999012345',
            'address' => 'Avenida Rio Branco, 150',
            'photo_path' => 'clientes/perfil.webp'
        ]);

        Client::create([
            'name' => 'Isabela Torres',
            'email' => 'isabela.torres@example.com',
            'phone' => '987001122',
            'address' => 'Rua Vitória, 17',
            'photo_path' => 'clientes/perfil.webp'
        ]);

        Client::create([
            'name' => 'Rodrigo Castro',
            'email' => 'rodrigo.castro@example.com',
            'phone' => '986112233',
            'address' => 'Av. das Nações, 89',
            'photo_path' => 'clientes/perfil.webp'
        ]);

        Client::create([
            'name' => 'Vanessa Martins',
            'email' => 'vanessa.martins@example.com',
            'phone' => '985223344',
            'address' => 'Rua Santo Antônio, 70',
            'photo_path' => 'clientes/perfil.webp'
        ]);

        Client::create([
            'name' => 'Gustavo Ribeiro',
            'email' => 'gustavo.ribeiro@example.com',
            'phone' => '984334455',
            'address' => 'Praça da Sé, 10',
            'photo_path' => 'clientes/perfil.webp'
        ]);

        Client::create([
            'name' => 'Larissa Campos',
            'email' => 'larissa.campos@example.com',
            'phone' => '983445566',
            'address' => 'Rua Independência, 42',
            'photo_path' => 'clientes/perfil.webp'
        ]);

        Client::create([
            'name' => 'Felipe Duarte',
            'email' => 'felipe.duarte@example.com',
            'phone' => '982556677',
            'address' => 'Rua do Comércio, 130',
            'photo_path' => 'clientes/perfil.webp'
        ]);

        Client::create([
            'name' => 'Renata Freitas',
            'email' => 'renata.freitas@example.com',
            'phone' => '981667788',
            'address' => 'Av. Tiradentes, 555',
            'photo_path' => 'clientes/perfil.webp'
        ]);

        Client::create([
            'name' => 'Carlos Henrique',
            'email' => 'carlos.henrique@example.com',
            'phone' => '980778899',
            'address' => 'Rua da Esperança, 90',
            'photo_path' => 'clientes/perfil.webp'
        ]);

        Client::create([
            'name' => 'Sofia Mendes',
            'email' => 'sofia.mendes@example.com',
            'phone' => '979889900',
            'address' => 'Av. das Palmeiras, 888',
            'photo_path' => 'clientes/perfil.webp'
        ]);

    }
}
