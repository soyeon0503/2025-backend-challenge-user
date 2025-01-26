<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(), // 제목: 랜덤 문장
            'content' => $this->faker->paragraphs(3, true), // 내용: 랜덤 3개의 문단을 하나로 합침
            'writer' => $this->faker->name(), // 작성자: 랜덤 이름
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
