<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
		// Create User firstly (to get email and id)
		$user = User::factory()->create();
		$user_id = $user->id;
		$user_email = $user->email;
		$company_id = \App\Models\Company::inRandomOrder()->value('id');
		return [
			'user_id' => $user_id,
			'email' => $user_email,
			'company_id' => $company_id,
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
			'phone_number' => $this->faker->e164PhoneNumber(),
        ];
    }
}
