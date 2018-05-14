<?php

use Illuminate\Database\Seeder;

class PaymentStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\PaymentStatus::class, 4)->create();
    }
}
