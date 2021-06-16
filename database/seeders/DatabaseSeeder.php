<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
		$this->call(CompanySeeder::class);
		$this->call(EmployeeSeeder::class);
		$this->call(RealizationSeeder::class);
		$this->call(RealizationEmployeeSeeder::class);
    }
}
