<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Company;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Manager>
 */
class ManagerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => fake()->unique()->safeEmail(),
            'name' => fake()->name(),
            'password' => Hash::make('password'),
            'phone' => fake()->phoneNumber(),
            'department' => fake()->text(25),
             // 실제 존재하는 회사 중 랜덤 선택
            'company_id' => Company::pluck('id')->random(),
        ];
    }
    
}
