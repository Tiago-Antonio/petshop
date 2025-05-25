<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Product::factory()->count(10)->create();

        Product::create([
            'name' => 'Pote de Ração Educativa',
            'description' => 'Ração whiskas',
            'photo_path' => 'img/products/spray_pet.webp',
            'purchase_price' => 80.0,
            'sale_price' => 120.0,
            'current_stock' => 50,
            'min_stock' => 10,
        ]);

        Product::create([
            'name' => 'Ração whiskas',
            'description' => 'Pote de Ração Educativa',
            'photo_path' => 'img/products/adestrador_xixi_dog_pet.webp',
            'purchase_price' => 15.5,
            'sale_price' => 29.9,
            'current_stock' => 30,
            'min_stock' => 5,
        ]);

        Product::create([
            'name' => 'Ração Golden',
            'description' => 'Ração Golden',
            'photo_path' => 'img/products/casa_dog_pet.webp',
            'purchase_price' => 12.75,
            'sale_price' => 22.5,
            'current_stock' => 20,
            'min_stock' => 3,
        ]);

        Product::create([
            'name' => 'Areia Sanitária Pipicat',
            'description' => 'Areia higiênica para gatos',
            'photo_path' => 'img/products/spray_pet.webp',
            'purchase_price' => 10.0,
            'sale_price' => 18.0,
            'current_stock' => 25,
            'min_stock' => 5,
        ]);

        Product::create([
            'name' => 'Coleira Antipulgas',
            'description' => 'Coleira antipulgas para cães de pequeno porte',
            'photo_path' => 'img/products/arroz_dog_pet.webp',
            'purchase_price' => 22.0,
            'sale_price' => 39.9,
            'current_stock' => 15,
            'min_stock' => 3,
        ]);

        Product::create([
            'name' => 'Shampoo Pet Neutro',
            'description' => 'Shampoo neutro para banho de cães e gatos',
            'photo_path' => 'img/products/casa_dog_pet.webp',
            'purchase_price' => 8.9,
            'sale_price' => 16.0,
            'current_stock' => 40,
            'min_stock' => 8,
        ]);

        Product::create([
            'name' => 'Brinquedo Bola de Borracha',
            'description' => 'Brinquedo interativo para cães',
            'photo_path' => 'img/products/racao_whiskas_gato.webp',
            'purchase_price' => 5.5,
            'sale_price' => 10.0,
            'current_stock' => 50,
            'min_stock' => 10,
        ]);

        Product::create([
            'name' => 'Arranhador para Gatos',
            'description' => 'Arranhador vertical com brinquedo',
            'photo_path' => 'img/products/casa_dog_pet.webp',
            'purchase_price' => 25.0,
            'sale_price' => 45.0,
            'current_stock' => 10,
            'min_stock' => 2,
        ]);

        Product::create([
            'name' => 'Comedouro Duplo Inox',
            'description' => 'Comedouro e bebedouro de inox para cães',
            'photo_path' => 'img/products/spray_pet.webp',
            'purchase_price' => 18.0,
            'sale_price' => 30.0,
            'current_stock' => 20,
            'min_stock' => 4,
        ]);

        Product::create([
            'name' => 'Ração Premier Filhotes',
            'description' => 'Ração para cães filhotes',
            'photo_path' => 'img/products/racao_golden_especial_adulto.webp',
            'purchase_price' => 30.0,
            'sale_price' => 55.0,
            'current_stock' => 25,
            'min_stock' => 5,
        ]);

        Product::create([
            'name' => 'Tapete Higiênico Petmais',
            'description' => 'Tapete absorvente para cães',
            'photo_path' => 'img/products/spray_pet.webp',
            'purchase_price' => 19.9,
            'sale_price' => 34.9,
            'current_stock' => 12,
            'min_stock' => 3,
        ]);

        Product::create([
            'name' => 'Petisco Bifinho',
            'description' => 'Petisco sabor carne para cães',
            'photo_path' => 'img/products/suplemento_dog_pet.webp',
            'purchase_price' => 3.5,
            'sale_price' => 6.5,
            'current_stock' => 60,
            'min_stock' => 15,
        ]);

        Product::create([
            'name' => 'Cama Pelúcia Gato',
            'description' => 'Caminha confortável para gatos',
            'photo_path' => 'img/products/racao_whiskas_gato.webp',
            'purchase_price' => 35.0,
            'sale_price' => 65.0,
            'current_stock' => 8,
            'min_stock' => 2,
        ]);

        Product::create([
            'name' => 'Casinha Plástica Média',
            'description' => 'Casinha para cães de porte médio',
            'photo_path' => 'img/products/arroz_dog_pet.webp',
            'purchase_price' => 50.0,
            'sale_price' => 90.0,
            'current_stock' => 6,
            'min_stock' => 2,
        ]);

        Product::create([
            'name' => 'Coleira com Guia',
            'description' => 'Coleira com guia reforçada',
            'photo_path' => 'img/products/racao_golden_especial_adulto.webp',
            'purchase_price' => 12.0,
            'sale_price' => 22.0,
            'current_stock' => 18,
            'min_stock' => 4,
        ]);

        Product::create([
            'name' => 'Ração Úmida Gato',
            'description' => 'Sachê de ração úmida sabor salmão',
            'photo_path' => 'img/products/racao_whiskas_gato.webp',
            'purchase_price' => 2.2,
            'sale_price' => 4.5,
            'current_stock' => 100,
            'min_stock' => 20,
        ]);

        Product::create([
            'name' => 'Escova para Pelos',
            'description' => 'Escova de cerdas macias',
            'photo_path' => 'img/products/racao_golden_especial_adulto.webp',
            'purchase_price' => 6.0,
            'sale_price' => 11.0,
            'current_stock' => 22,
            'min_stock' => 4,
        ]);

        Product::create([
            'name' => 'Antipulgas Frontline',
            'description' => 'Antipulgas em pipeta para cães até 10kg',
            'photo_path' => 'img/products/adestrador_xixi_dog_pet.webp',
            'purchase_price' => 38.0,
            'sale_price' => 59.9,
            'current_stock' => 10,
            'min_stock' => 3,
        ]);

        Product::create([
            'name' => 'Sugador de Pelos',
            'description' => 'Aspirador portátil para pelos de pet',
            'photo_path' => 'img/products/pote_racao_educativo.webp',
            'purchase_price' => 45.0,
            'sale_price' => 79.0,
            'current_stock' => 5,
            'min_stock' => 1,
        ]);

        Product::create([
            'name' => 'Cortador de Unhas Pet',
            'description' => 'Cortador de unhas com limitador',
            'photo_path' => 'img/products/arroz_dog_pet.webp',
            'purchase_price' => 7.9,
            'sale_price' => 13.0,
            'current_stock' => 16,
            'min_stock' => 3,
        ]);

        Product::create([
            'name' => 'Ração Equilíbrio Gato Castrado',
            'description' => 'Ração para gatos castrados',
            'photo_path' => 'img/products/racao_whiskas_gato.webp',
            'purchase_price' => 40.0,
            'sale_price' => 72.0,
            'current_stock' => 14,
            'min_stock' => 4,
        ]);

        Product::create([
            'name' => 'Perfume para Pets',
            'description' => 'Colônia suave para cães e gatos',
            'photo_path' => 'img/products/racao_whiskas_gato.webp',
            'purchase_price' => 9.0,
            'sale_price' => 16.5,
            'current_stock' => 13,
            'min_stock' => 3,
        ]);

        Product::create([
            'name' => 'Alimento Natural Cozido',
            'description' => 'Porção de alimento natural para cães',
            'photo_path' => 'img/products/pote_racao_educativo.webp',
            'purchase_price' => 12.0,
            'sale_price' => 20.0,
            'current_stock' => 7,
            'min_stock' => 2,
        ]);

        Product::create([
            'name' => 'Brinquedo Mordedor de Nylon',
            'description' => 'Brinquedo resistente para mastigação',
            'photo_path' => 'img/products/pote_racao_educativo.webp',
            'purchase_price' => 8.0,
            'sale_price' => 14.9,
            'current_stock' => 30,
            'min_stock' => 6,
        ]);

        Product::create([
            'name' => 'Comedouro Automático',
            'description' => 'Dispensador de ração automático',
            'photo_path' => 'img/products/suplemento_dog_pet.webp',
            'purchase_price' => 60.0,
            'sale_price' => 99.0,
            'current_stock' => 9,
            'min_stock' => 2,
        ]);

        Product::create([
            'name' => 'Fonte Bebedouro Pet',
            'description' => 'Fonte de água elétrica para gatos e cães',
            'photo_path' => 'img/products/spray_pet.webp',
            'purchase_price' => 70.0,
            'sale_price' => 110.0,
            'current_stock' => 6,
            'min_stock' => 2,
        ]);

        Product::create([
            'name' => 'Jaqueta Impermeável Pet',
            'description' => 'Roupa impermeável para cães',
            'photo_path' => 'img/products/racao_whiskas_gato.webp',
            'purchase_price' => 28.0,
            'sale_price' => 49.0,
            'current_stock' => 12,
            'min_stock' => 3,
        ]);

        Product::create([
            'name' => 'Pente Removedor de Pulgas',
            'description' => 'Pente fino para remoção de pulgas',
            'photo_path' => 'img/products/pote_racao_educativo.webp',
            'purchase_price' => 4.0,
            'sale_price' => 7.9,
            'current_stock' => 17,
            'min_stock' => 4,
        ]);

        Product::create([
            'name' => 'Petisco Dentalbone',
            'description' => 'Petisco que auxilia na limpeza dos dentes',
            'photo_path' => 'img/products/pote_racao_educativo.webp',
            'purchase_price' => 6.0,
            'sale_price' => 10.9,
            'current_stock' => 35,
            'min_stock' => 8,
        ]);

        Product::create([
            'name' => 'Bolsa Transporte Pet',
            'description' => 'Bolsa reforçada para transporte de pets',
            'photo_path' => 'img/products/casa_cat_pet.webp',
            'purchase_price' => 55.0,
            'sale_price' => 99.0,
            'current_stock' => 4,
            'min_stock' => 1,
        ]);  
    }
}
