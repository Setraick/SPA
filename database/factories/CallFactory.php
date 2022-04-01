<?php

namespace Database\Factories;

use App\Models\Call;
use Illuminate\Database\Eloquent\Factories\Factory;

class CallFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Call::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $min=30;
        $max=1000;
        $um=1;
        $dois=2;
        return [
            'time'=> $this->faker->dateTime(),
            'duration'=> $this->faker->numberBetween($min, $max),
            'reply_time'=> $this->faker->numberBetween($min, $max),
            'satisfaction_score'=> $this->faker->numberBetween($um, $dois),
            'collaborator'=> $this->faker->name(),
        ];
    }
}
