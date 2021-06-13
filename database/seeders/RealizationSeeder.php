<?php

namespace Database\Seeders;

use App\Models\Realization;
use Illuminate\Database\Seeder;

class RealizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Realization::factory()->times(10)->create();
    }
}
