<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Company;
use App\Models\Manager;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->text(50),
            'content' => fake()->paragraph(3),
            'status' => fake()->randomElement([0, 1]),
            'company_id' => Company::pluck('id')->random(),
            'manager_id' => Manager::pluck('id')->random(),
            'product_id' => Product::pluck('id')->random(),
        ];
    }
}
