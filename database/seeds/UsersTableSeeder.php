<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regularRole = \App\UserRole::where('name', 'admin')->first();
        \App\User::create([
            'name' => 'Michael Ignatiev',
            'email' => 'michael.ignatiev.1989@gmail.com',
            'phone' => '380500888888',
            'password' => bcrypt('123456'),
            'role_id' => $regularRole->id,
            'is_active' => true,
        ]);
        
        factory(App\User::class, 50)->create();
    }
}
