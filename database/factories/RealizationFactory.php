<?php

namespace Database\Factories;

use App\Models\Realization;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RealizationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Realization::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
			'name' => $this->faker->uuid(),
			'city' => $this->faker->city(),
			'street' => $this->faker->streetName(),
			'number' => $this->faker->randomDigitNotZero(),
			'owner_id' => User::all()->random()->id,
            //
        ];
    }
}
