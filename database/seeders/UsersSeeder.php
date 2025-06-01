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
            'phone'    => '11912345678',
            'role'     => 'Desenvolvedor',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('123'),
            'admin'=>true,
        ]);
        User::create([
            'name'     => 'Jonathan',
            'email'    => 'jota@gmail.com',
            'phone'    => '9999999',
            'role'     => 'Desenvolvedor',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('jota'),
            'admin'=>true,
        ]);
        User::create([
            'name'     => 'admin',
            'email'    => 'admin@admin.com',
            'phone'    => '11912345679',
            'role'     => 'Desenvolvedor',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('adm'),
            'admin'=>true,
        ]);
        User::create([
            'name'     => 'João Silva',
            'email'    => 'joao.silva@example.com',
            'phone'    => '11912345680',
            'role'     => 'Desenvolvedor',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('123'),
        ]);

        User::create([
            'name'     => 'Admin Silva',
            'email'    => 'admin@admin',
            'phone'    => '11983746765',
            'role'     => 'Auxiliar',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('123'),
            'admin'=>true,
        ]);

         User::create([
            'name'     => 'Usuario Silva',
            'email'    => 'user@user',
            'phone'    => '11983746765',
            'role'     => 'Auxiliar',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('123'),
        ]);

        User::create([
            'name'     => 'Tiago',
            'email'    => 'tiago.carlos@example.com',
            'phone'    => '11994736527',
            'role'     => 'Estagiario',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('olamundopet'),
        ]);

        User::create([
            'name'     => 'Maria Oliveira',
            'email'    => 'maria.oliveira@example.com',
            'phone'    => '11998765432',
            'role'     => 'Designer',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);

        User::create([
            'name'     => 'Carlos Souza',
            'email'    => 'carlos.souza@example.com',
            'phone'    => '11911223344',
            'role'     => 'Gerente',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);

        User::create([
            'name'     => 'Ana Pereira',
            'email'    => 'ana.pereira@example.com',
            'phone'    => '11933445566',
            'role'     => 'Analista de Sistemas',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);

        User::create([
            'name'     => 'Paulo Costa',
            'email'    => 'paulo.costa@example.com',
            'phone'    => '11944556677',
            'role'     => 'Marketing',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);

        User::create([
            'name'     => 'Lucas Lima',
            'email'    => 'lucas.lima@example.com',
            'phone'    => '11955667788',
            'role'     => 'Suporte Técnico',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);

        User::create([
            'name'     => 'Fernanda Alves',
            'email'    => 'fernanda.alves@example.com',
            'phone'    => '11966778899',
            'role'     => 'Recursos Humanos',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);

        User::create([
            'name'     => 'Mariana Silva',
            'email'    => 'mariana.silva@example.com',
            'phone'    => '11977889900',
            'role'     => 'Designer Gráfico',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);

        User::create([
            'name'     => 'Eduardo Pereira',
            'email'    => 'eduardo.pereira@example.com',
            'phone'    => '11988990011',
            'role'     => 'Vendas',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);

        User::create([
            'name'     => 'Juliana Rocha',
            'email'    => 'juliana.rocha@example.com',
            'phone'    => '11999001122',
            'role'     => 'Gerente de TI',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);

        User::create([
            'name'     => 'Ricardo Almeida',
            'email'    => 'ricardo.almeida@example.com',
            'phone'    => '11910101010',
            'role'     => 'Estagiário',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);

        User::create([
            'name'     => 'Tatiane Costa',
            'email'    => 'tatiane.costa@example.com',
            'phone'    => '11920202020',
            'role'     => 'Secretária',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);

        User::create([
            'name'     => 'Fábio Santos',
            'email'    => 'fabio.santos@example.com',
            'phone'    => '11930303030',
            'role'     => 'Analista de Marketing',
            'photo_path'=> '/img/funcionarios/perfil.webp',
            'birth_date'=> '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);


    }
}
