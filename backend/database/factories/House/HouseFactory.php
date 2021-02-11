<?php

namespace Database\Factories\House;

use App\Models\House\House;
use Illuminate\Database\Eloquent\Factories\Factory;

class HouseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = House::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'      => $this->faker->name,
            'price'     => $this->faker->numberBetween(1000, 5000) * 100,
            'bedrooms'  => $this->faker->numberBetween(1, 5),
            'bathrooms' => $this->faker->numberBetween(1, 5),
            'storeys'   => $this->faker->numberBetween(1, 5),
            'garages'   => $this->faker->numberBetween(1, 5),
        ];
    }
}
