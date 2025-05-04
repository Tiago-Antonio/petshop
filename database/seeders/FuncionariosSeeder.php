<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Funcionario;
use Illuminate\Support\Facades\Hash;


class FuncionariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Funcionario::create([
            'nome'     => 'João Silva',
            'email'    => 'joao.silva@example.com',
            'telefone' => '123456789', 
            'cargo'    => 'Desenvolvedor',
            'path_foto'    => '/img/funcionarios/perfil.webp',
            'data_nascimento'    => '1999-10-12',
            'password'    => Hash::make('123pet'),
            

        ]);

        Funcionario::create([
            'nome'     => 'Silva',
            'email'    => 'silva@example.com',
            'telefone' => '837467653', 
            'cargo'    => 'Auxiliar',
            'path_foto'    => '/img/funcionarios/perfil.webp',
            'data_nascimento'    => '1999-10-12',
            'password'    => Hash::make('petshop'),

        ]);

        Funcionario::create([
            'nome'     => 'Tiago',
            'email'    => 'tiago.carlos@example.com',
            'telefone' => '947365274', 
            'cargo'    => 'Estagiario',
            'path_foto'    => '/img/funcionarios/perfil.webp',
            'data_nascimento'    => '1999-10-12',
            'password'    => Hash::make('olamundopet'),
        ]);

        Funcionario::create([
            'nome' => 'Maria Oliveira',
            'email' => 'maria.oliveira@example.com',
            'telefone' => '987654321',
            'cargo' => 'Designer',
            'path_foto'    => '/img/funcionarios/perfil.webp',
            'data_nascimento'    => '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);

        Funcionario::create([
            'nome' => 'Carlos Souza',
            'email' => 'carlos.souza@example.com',
            'telefone' => '1122334455',
            'cargo' => 'Gerente',
            'path_foto'    => '/img/funcionarios/perfil.webp',
            'data_nascimento'    => '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);

        Funcionario::create([
            'nome' => 'Ana Pereira',
            'email' => 'ana.pereira@example.com',
            'telefone' => '3344556677',
            'cargo' => 'Analista de Sistemas',
            'path_foto'    => '/img/funcionarios/perfil.webp',
            'data_nascimento'    => '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);

        Funcionario::create([
            'nome' => 'Paulo Costa',
            'email' => 'paulo.costa@example.com',
            'telefone' => '4455667788',
            'cargo' => 'Marketing',
            'path_foto'    => '/img/funcionarios/perfil.webp',
            'data_nascimento'    => '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);

        Funcionario::create([
            'nome' => 'Lucas Lima',
            'email' => 'lucas.lima@example.com',
            'telefone' => '5566778899',
            'cargo' => 'Suporte Técnico',
            'path_foto'    => '/img/funcionarios/perfil.webp',
            'data_nascimento'    => '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);

        Funcionario::create([
            'nome' => 'Fernanda Alves',
            'email' => 'fernanda.alves@example.com',
            'telefone' => '6677889900',
            'cargo' => 'Recursos Humanos',
            'path_foto'    => '/img/funcionarios/perfil.webp',
            'data_nascimento'    => '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);

        Funcionario::create([
            'nome' => 'Mariana Silva',
            'email' => 'mariana.silva@example.com',
            'telefone' => '7788990011',
            'cargo' => 'Designer Gráfico',
            'path_foto'    => '/img/funcionarios/perfil.webp',
            'data_nascimento'    => '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);

        Funcionario::create([
            'nome' => 'Eduardo Pereira',
            'email' => 'eduardo.pereira@example.com',
            'telefone' => '8899001122',
            'cargo' => 'Vendas',
            'path_foto'    => '/img/funcionarios/perfil.webp',
            'data_nascimento'    => '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);

        Funcionario::create([
            'nome' => 'Juliana Rocha',
            'email' => 'juliana.rocha@example.com',
            'telefone' => '9900112233',
            'cargo' => 'Gerente de TI',
            'path_foto'    => '/img/funcionarios/perfil.webp',
            'data_nascimento'    => '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);

        Funcionario::create([
            'nome' => 'Ricardo Almeida',
            'email' => 'ricardo.almeida@example.com',
            'telefone' => '1010101010',
            'cargo' => 'Estagiário',
            'path_foto'    => '/img/funcionarios/perfil.webp',
            'data_nascimento'    => '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);

        Funcionario::create([
            'nome' => 'Tatiane Costa',
            'email' => 'tatiane.costa@example.com',
            'telefone' => '2020202020',
            'cargo' => 'Secretária',
            'path_foto'    => '/img/funcionarios/perfil.webp',
            'data_nascimento'    => '1999-10-12',
            'password' => Hash::make('123pet'),
        ]);

        Funcionario::create([
            'nome' => 'Fábio Santos',
            'email' => 'fabio.santos@example.com',
            'telefone' => '3030303030',
            'path_foto'    => '/img/funcionarios/perfil.webp',
            'data_nascimento'    => '1999-10-12',
            'cargo' => 'Analista de Marketing',
            'password' => Hash::make('123pet'),
        ]);


    }
}
