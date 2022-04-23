<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'     => User::factory(),
            'title'       => $this->faker->title(),
            'body'        => $this->faker->realText($maxNbChars = 10, $indexSize = 2),
            'status'      => 1,
            'thummbnail'  => '"http://localhost/storage/images/MyIcon.jpeg"',
        ];
    }
}
