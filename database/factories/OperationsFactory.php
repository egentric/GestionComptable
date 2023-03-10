<?php

namespace Database\Factories;

use App\Models\Categories;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OperationsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'operationDescription' => $this->faker->words(3, true),
            'operationDate' => $this->faker-> dateTime(),
            'operationSomme' => rand(-2000,2000) ,
            'category_id' => rand(1, Categories::count()),

        ];
    }
}
