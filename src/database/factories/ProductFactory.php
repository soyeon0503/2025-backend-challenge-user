<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Company;
use App\Models\Manager;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->text(50),
            'price' => fake()->numberBetween(100, 1000000),
            'description' => fake()->text(),
            'status' => fake()->randomElement([0, 1]),
            'company_id' => Company::pluck('id')->random(),
            'manager_id' => Manager::pluck('id')->random(),
        ];
    }
    
}
