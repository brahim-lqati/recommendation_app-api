<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->realText(10),
            'image' => $this->faker->imageUrl(200, 200),
            'address' => $this->faker->address,
            'rating' => rand(1,5),
            'latitude' => 0.1234,
            'longitude' => 0.3467
        ];
    }
}
