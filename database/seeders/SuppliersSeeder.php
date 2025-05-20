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
            'name' => 'Cavalcanti Gomes - EI',
            'email' => 'vitor88@da.net',
            'phone' => '+550118099',
            'address' => 'Núcleo de Vieira, 69, Maravilha, 99751-505 da Luz dos Dourados / AL',
        ]);

        Supplier::create([
            'name' => 'Costa',
            'email' => 'jaragao@teixeira.br',
            'phone' => '0813851156',
            'address' => 'Vereda Novaes, 4, Biquinhas, 24066322 Monteiro das Pedras / AM',
        ]);

        Supplier::create([
            'name' => 'Ferreira',
            'email' => 'enrico85@rodrigues.com',
            'phone' => '3131622820',
            'address' => 'Jardim Milena Martins, 1, Confisco, 36919-401 Jesus / PI',
        ]);

        Supplier::create([
            'name' => 'da Mota Cardoso S.A.',
            'email' => 'carvalholucca@monteiro.com',
            'phone' => '+558163110',
            'address' => 'Condomínio de Farias, Ademar Maldonado, 41192-672 Aragão das Flores / SC',
        ]);

        Supplier::create([
            'name' => 'Carvalho',
            'email' => 'isabellasilva@farias.net',
            'phone' => '0515397046',
            'address' => 'Chácara de Porto, 206, Alta Tensão 2ª Seção, 53957-438 da Mata do Galho / BA',
        ]);

        Supplier::create([
            'name' => 'Barros',
            'email' => 'samuelbarros@ribeiro.com',
            'phone' => '+557160279',
            'address' => 'Praia das Neves, 23, Vila Da Luz, 54098999 Cardoso do Oeste / PE',
        ]);

        Supplier::create([
            'name' => 'Porto',
            'email' => 'da-rosasophie@santos.br',
            'phone' => '+550210089',
            'address' => 'Fazenda Vitor Gabriel Barbosa, 91, Vila Aeroporto, 78857419 Rodrigues do Amparo / MT',
        ]);

        Supplier::create([
            'name' => 'Dias',
            'email' => 'cavalcantileticia@pires.br',
            'phone' => '0212963819',
            'address' => 'Recanto de Cardoso, Vila Suzana Segunda Seção, 59541-656 Jesus / SP',
        ]);

        Supplier::create([
            'name' => 'Barbosa e Filhos',
            'email' => 'diogosilveira@da.net',
            'phone' => '0413379717',
            'address' => 'Loteamento Fogaça, 608, Delta, 71267-173 Araújo / AL',
        ]);

        Supplier::create([
            'name' => 'Ribeiro',
            'email' => 'xsilveira@correia.br',
            'phone' => '+552162146',
            'address' => 'Condomínio de Duarte, 279, Anchieta, 75410-120 Teixeira / CE',
        ]);

        Supplier::create([
            'name' => 'Barros - ME',
            'email' => 'gda-rosa@rocha.com',
            'phone' => '0715256484',
            'address' => 'Travessa Lucca Cardoso, 65, Novo Aarão Reis, 57769-945 Moreira / GO',
        ]);

        Supplier::create([
            'name' => 'da Mota',
            'email' => 'marialopes@fernandes.org',
            'phone' => '4118134431',
            'address' => 'Vale Luiz Miguel Martins, 85, São Gonçalo, 36148-276 Lopes de Goiás / SC',
        ]);

        Supplier::create([
            'name' => 'Rezende Silveira - EI',
            'email' => 'raquel62@moraes.br',
            'phone' => '0114882570',
            'address' => 'Vereda de da Luz, 24, Conjunto Jatoba, 88069356 Ramos de Gomes / MS',
        ]);

        Supplier::create([
            'name' => 'Jesus',
            'email' => 'duartehenrique@nascimento.com',
            'phone' => '+550215628',
            'address' => 'Recanto Milena Cardoso, 8, Araguaia, 64504919 Rodrigues dos Dourados / BA',
        ]);

        Supplier::create([
            'name' => 'Ramos',
            'email' => 'fariasheitor@nunes.br',
            'phone' => '+550713723',
            'address' => 'Distrito Kevin Rezende, 247, Vila Da Amizade, 83755485 Aragão / ES',
        ]);

        Supplier::create([
            'name' => 'Duarte',
            'email' => 'benjaminsilveira@correia.br',
            'phone' => '+550510683',
            'address' => 'Residencial Augusto Santos, 293, Alto Das Antenas, 68478-384 Gomes de Silveira / PI',
        ]);

        Supplier::create([
            'name' => 'da Mata',
            'email' => 'barrosalicia@azevedo.org',
            'phone' => '+550711899',
            'address' => 'Conjunto de Caldeira, 422, Marçola, 14022623 Barbosa de Carvalho / PE',
        ]);

        Supplier::create([
            'name' => 'Sales S.A.',
            'email' => 'ypires@ramos.net',
            'phone' => '0116798006',
            'address' => 'Favela de Nascimento, 699, Jardim Leblon, 91363-738 Teixeira de Cardoso / RJ',
        ]);

        Supplier::create([
            'name' => 'Cardoso',
            'email' => 'cecilia96@da.br',
            'phone' => '0300187928',
            'address' => 'Travessa de Oliveira, 36, Novo Tupi, 16359558 Barros de Cardoso / DF',
        ]);

        Supplier::create([
            'name' => 'Rezende',
            'email' => 'cecilia97@correia.com',
            'phone' => '1149733408',
            'address' => 'Fazenda Melissa Cunha, 65, Fazendinha, 86786-681 Martins / PR',
        ]);

        Supplier::create([
            'name' => 'Vieira',
            'email' => 'luiz-gustavomoura@ramos.com',
            'phone' => '0841372032',
            'address' => 'Favela da Luz, 24, Vila Nova Gameleira 1ª Seção, 42820-198 Moura do Norte / AC',
        ]);

        Supplier::create([
            'name' => 'Castro S.A.',
            'email' => 'qcunha@peixoto.net',
            'phone' => '+550612732',
            'address' => 'Lago Arthur Pereira, 841, Vila Madre Gertrudes 1ª Seção, 81764-201 Dias das Pedras / PB',
        ]);

        Supplier::create([
            'name' => 'Silveira',
            'email' => 'goncalvesluiz-felipe@da.br',
            'phone' => '+551152232',
            'address' => 'Estrada Pinto, 97, Planalto, 85183-934 da Costa das Flores / GO',
        ]);

        Supplier::create([
            'name' => 'Martins S.A.',
            'email' => 'alopes@monteiro.com',
            'phone' => '0841609903',
            'address' => 'Recanto de da Paz, 48, Das Industrias I, 84073256 Nunes Alegre / RN',
        ]);

        Supplier::create([
            'name' => 'Aragão Gomes - ME',
            'email' => 'da-conceicaoyuri@pereira.br',
            'phone' => '0316885323',
            'address' => 'Estação Fogaça, 68, Padre Eustáquio, 21657917 Monteiro / GO',
        ]);

        Supplier::create([
            'name' => 'da Mata Silva Ltda.',
            'email' => 'cribeiro@freitas.br',
            'phone' => '0519686869',
            'address' => 'Fazenda Lara Carvalho, 38, Senhor Dos Passos, 89924-242 Carvalho / AM',
        ]);

        Supplier::create([
            'name' => 'Ramos - ME',
            'email' => 'emanuel39@fernandes.br',
            'phone' => '+555189969',
            'address' => 'Estação Luana Correia, 5, Outro, 51880-474 das Neves de Minas / RJ',
        ]);

        Supplier::create([
            'name' => 'Souza Moraes e Filhos',
            'email' => 'brenovieira@campos.org',
            'phone' => '+553153378',
            'address' => 'Distrito Aragão, 3, Cdi Jatoba, 25051743 Fernandes de da Mota / RN',
        ]);

        Supplier::create([
            'name' => 'Fogaça - EI',
            'email' => 'rpinto@castro.org',
            'phone' => '+552109672',
            'address' => 'Praia Lavínia da Luz, 53, Floramar, 17722388 Araújo dos Dourados / MT',
        ]);

        Supplier::create([
            'name' => 'Rezende',
            'email' => 'vnogueira@da.br',
            'phone' => '0300768543',
            'address' => 'Quadra da Mata, 47, Cruzeiro, 91075-928 Correia / AC',
        ]);

        Supplier::create([
            'name' => 'Viana das Neves S/A',
            'email' => 'bruno48@ferreira.br',
            'phone' => '0116521056',
            'address' => 'Parque de da Conceição, 2, Ipe, 66193110 Cardoso dos Dourados / MT',
        ]);

        Supplier::create([
            'name' => 'Fogaça',
            'email' => 'martinsbrenda@porto.br',
            'phone' => '+558473392',
            'address' => 'Feira de Sales, Novo Tupi, 08202-620 Moura / MT',
        ]);

        Supplier::create([
            'name' => 'Lima S/A',
            'email' => 'andre51@farias.net',
            'phone' => '0300417324',
            'address' => 'Trecho Jesus, 24, Nova Cintra, 68858-789 Santos / RN',
        ]);

        Supplier::create([
            'name' => 'Barbosa',
            'email' => 'gabrielacaldeira@duarte.net',
            'phone' => '2176638852',
            'address' => 'Fazenda Nicolas da Luz, 96, Conjunto Jardim Filadélfia, 57986007 Silva de Monteiro / CE',
        ]);

        Supplier::create([
            'name' => 'Ferreira S.A.',
            'email' => 'giovannaferreira@rezende.br',
            'phone' => '0900707937',
            'address' => 'Praia de Rezende, 34, Vila Rica, 41780232 Freitas / PA',
        ]);

        Supplier::create([
            'name' => 'da Rosa das Neves S/A',
            'email' => 'ana-clararocha@rodrigues.br',
            'phone' => '0111722694',
            'address' => 'Travessa de da Paz, 73, Pompéia, 83459-814 Campos / AM',
        ]);

        Supplier::create([
            'name' => 'da Mota - ME',
            'email' => 'luiz-otavio92@fogaca.br',
            'phone' => '+551111223',
            'address' => 'Alameda de Martins, 82, Santa Maria, 39109-219 Moura / TO',
        ]);

        Supplier::create([
            'name' => 'Lopes',
            'email' => 'rodriguesjoao-felipe@ferreira.com',
            'phone' => '0518052569',
            'address' => 'Vale da Rocha, 41, Custodinha, 60386-137 Farias da Prata / PA',
        ]);

        Supplier::create([
            'name' => 'Araújo da Conceição - ME',
            'email' => 'levi42@cavalcanti.com',
            'phone' => '3131125148',
            'address' => 'Aeroporto de Rocha, 18, Jardim Do Vale, 38714-897 da Luz do Norte / MS',
        ]);

        Supplier::create([
            'name' => 'Castro Azevedo - EI',
            'email' => 'silvaclarice@da.br',
            'phone' => '6194729971',
            'address' => 'Avenida Ramos, 15, Madri, 89328-330 Nogueira / PB',
        ]);

        Supplier::create([
            'name' => 'Santos',
            'email' => 'da-luzlivia@vieira.com',
            'phone' => '+550517745',
            'address' => 'Sítio Castro, 3, Vila Nova Gameleira 2ª Seção, 22076-250 Pinto do Campo / GO',
        ]);

        Supplier::create([
            'name' => 'Rocha',
            'email' => 'aragaomariana@porto.br',
            'phone' => '3101015295',
            'address' => 'Praça de Fogaça, 30, Leonina, 88649-224 da Mata das Flores / PI',
        ]);

        Supplier::create([
            'name' => 'Fogaça Jesus S/A',
            'email' => 'amanda31@pires.com',
            'phone' => '7167929534',
            'address' => 'Conjunto Jesus, 85, Califórnia, 06872425 Barros de Peixoto / DF',
        ]);

        Supplier::create([
            'name' => 'Porto S.A.',
            'email' => 'heitorribeiro@viana.com',
            'phone' => '0415970610',
            'address' => 'Área de Cunha, 877, São Tomaz, 89921319 Gonçalves da Prata / PR',
        ]);

        Supplier::create([
            'name' => 'Souza',
            'email' => 'xcunha@lopes.com',
            'phone' => '+550114038',
            'address' => 'Rua Barbosa, Jardim América, 17173-568 Nascimento de da Costa / MG',
        ]);

        Supplier::create([
            'name' => 'Moreira',
            'email' => 'luigisales@da.br',
            'phone' => '+550612246',
            'address' => 'Alameda Maria Fernanda Rodrigues, Vila Nova Gameleira 1ª Seção, 70902060 Monteiro / AL',
        ]);

        Supplier::create([
            'name' => 'Freitas Cunha - EI',
            'email' => 'helena72@cardoso.com',
            'phone' => '+558419262',
            'address' => 'Loteamento de da Mota, 15, Bandeirantes, 84941116 Novaes / BA',
        ]);

        Supplier::create([
            'name' => 'Correia',
            'email' => 'julianada-mata@farias.br',
            'phone' => '0818905634',
            'address' => 'Alameda Vitor Gabriel Duarte, 84, Vila Das Oliveiras, 42138249 Pires / AP',
        ]);

        Supplier::create([
            'name' => 'da Cruz',
            'email' => 'melissa12@da.com',
            'phone' => '+550219244',
            'address' => 'Distrito Jesus, 26, Conjunto Paulo Vi, 31001028 da Rocha / SE',
        ]);

        Supplier::create([
            'name' => 'Silva',
            'email' => 'caldeiracaroline@novaes.com',
            'phone' => '+553172437',
            'address' => 'Passarela Diogo Gonçalves, 802, Sion, 51545-721 Cardoso / BA',
        ]);

    }
}

