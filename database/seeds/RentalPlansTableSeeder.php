<?php

use Illuminate\Database\Seeder;

class RentalPlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\RentalPlan::class, 5)->create();
    }
}
