<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserRolesTableSeeder::class);
        $this->call(UserActionsTableSeeder::class);
        $this->call(UserActionUserRoleTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RentalPlansTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(BranchesTableSeeder::class);
        $this->call(ProductTypesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(PaymentTypesTableSeeder::class);
        $this->call(PaymentStatusesTableSeeder::class);
        $this->call(DiscountsTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
    }
}
