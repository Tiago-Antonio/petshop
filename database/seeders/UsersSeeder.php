<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'     => 'Tiago Carlos',
            'email'    => 'tiagoantoniocarlos.btu@gmail.com',
            'phone'    => '123456789',
            'role'     => 'Desenvolvedor',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('123'),
            'admin'=>true,
        ]);
        User::create([
            'name'     => 'admin',
            'email'    => 'admin@admin.com',
            'phone'    => '123456789',
            'role'     => 'Desenvolvedor',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('adm'),
            'admin'=>true,
        ]);
        User::create([
            'name'     => 'João Silva',
            'email'    => 'joao.silva@example.com',
            'phone'    => '123456789',
            'role'     => 'Desenvolvedor',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('123'),
        ]);
        
        User::create([
            'name'     => 'Admin Silva',
            'email'    => 'admin@admin',
            'phone'    => '837467653',
            'role'     => 'Auxiliar',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('123'),
            'admin'=>true,
        ]);
        
        User::create([
            'name'     => 'Tiago',
            'email'    => 'tiago.carlos@example.com',
            'phone'    => '947365274',
            'role'     => 'Estagiario',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('olamundopet'),
        ]);
        
        User::create([
            'name'     => 'Maria Oliveira',
            'email'    => 'maria.oliveira@example.com',
            'phone'    => '987654321',
            'role'     => 'Designer',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);
        
        User::create([
            'name'     => 'Carlos Souza',
            'email'    => 'carlos.souza@example.com',
            'phone'    => '1122334455',
            'role'     => 'Gerente',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);
        
        User::create([
            'name'     => 'Ana Pereira',
            'email'    => 'ana.pereira@example.com',
            'phone'    => '3344556677',
            'role'     => 'Analista de Sistemas',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);
        
        User::create([
            'name'     => 'Paulo Costa',
            'email'    => 'paulo.costa@example.com',
            'phone'    => '4455667788',
            'role'     => 'Marketing',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);
        
        User::create([
            'name'     => 'Lucas Lima',
            'email'    => 'lucas.lima@example.com',
            'phone'    => '5566778899',
            'role'     => 'Suporte Técnico',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);
        
        User::create([
            'name'     => 'Fernanda Alves',
            'email'    => 'fernanda.alves@example.com',
            'phone'    => '6677889900',
            'role'     => 'Recursos Humanos',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);
        
        User::create([
            'name'     => 'Mariana Silva',
            'email'    => 'mariana.silva@example.com',
            'phone'    => '7788990011',
            'role'     => 'Designer Gráfico',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);
        
        User::create([
            'name'     => 'Eduardo Pereira',
            'email'    => 'eduardo.pereira@example.com',
            'phone'    => '8899001122',
            'role'     => 'Vendas',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);
        
        User::create([
            'name'     => 'Juliana Rocha',
            'email'    => 'juliana.rocha@example.com',
            'phone'    => '9900112233',
            'role'     => 'Gerente de TI',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);
        
        User::create([
            'name'     => 'Ricardo Almeida',
            'email'    => 'ricardo.almeida@example.com',
            'phone'    => '1010101010',
            'role'     => 'Estagiário',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);
        
        User::create([
            'name'     => 'Tatiane Costa',
            'email'    => 'tatiane.costa@example.com',
            'phone'    => '2020202020',
            'role'     => 'Secretária',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);
        
        User::create([
            'name'     => 'Fábio Santos',
            'email'    => 'fabio.santos@example.com',
            'phone'    => '3030303030',
            'role'     => 'Analista de Marketing',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);

    }
}
