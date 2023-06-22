<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PublicFoto>
 */
class PublicFotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //faker for nama foto
            'name' => $this->faker->name(),
            //faker for path foto
            'path' => 'default.png',
            'user_id' => '11',
        ];
    }
}
