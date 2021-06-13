<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Realization;
class RealizationEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
		$realizations = Realization::All();

		Employee::All()->each(function ($employee) use ($realizations) {
			$employee->realizations()->attach(
				$realizations->random(rand(1, $realizations->count()))->pluck('id')->toArray()
			);
		});
    }
}
