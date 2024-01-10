<?php

namespace Database\Factories;

use App\Models\Product;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $categoryIds = Categorie::pluck('id')->toArray();
        return [
            'name' => $this->faker->word,
            'image' => $this->faker->imageUrl(),
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 10, 100),
            'categorie_id' => $this->faker->randomElement($categoryIds)
        ];
    }
}
