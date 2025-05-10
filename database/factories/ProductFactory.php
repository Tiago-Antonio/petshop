<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imagens = [
            'img/products/racao_whiskas_gato.webp',
            'img/products/pote_racao_educativo.webp',
            'img/products/racao_golden_special_adulto.webp',
            'img/products/spray_pet.webp',
            'img/products/suplemento_dog_pet.webp',
            'img/products/food_dog_adulto_pet.webp',
            'img/products/casa_dog_pet.webp',
            'img/products/casa_cat_pet.webp',
            'img/products/arroz_dog_pet.webp',
            'img/products/adestrador_xixi_dog_pet.webp',
        ];
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'photo_path' => $this->faker->randomElement($imagens), 
            'purchase_price' => $this->faker->randomFloat(2, 10, 100),
            'sale_price' => $this->faker->randomFloat(2, 20, 200),
            'current_stock' => $this->faker->numberBetween(0, 100),
            'min_stock' => $this->faker->numberBetween(1, 20),
        ];
    }
}
