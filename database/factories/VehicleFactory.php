<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'plate_number'=> $this->faker->regexify('[A-Za-z0-9]{6}'),
            'plate_country'=> $this->faker->country(),
            'brand'=> $this->faker->name(),
            'model'=> $this->faker->name(),
            'year'=> $this->faker->numberBetween(0,30),
            'fuel_type'=> $this->faker->numberBetween(0,4),
            'horsepower'=> $this->faker->numberBetween(300,3000),
            'engine_cc'=> $this->faker->numberBetween(300,3000),
            'vin_numb'=> $this->faker->regexify('[A-Za-z0-9]{17}'),
        ];
    }
}
