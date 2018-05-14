<?php

use Illuminate\Database\Seeder;

class UserActionUserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\UserActionUserRole::create([
            'user_action_id' => 1,
            'user_role_id' => 1,
        ]);
        \App\UserActionUserRole::create([
            'user_action_id' => 1,
            'user_role_id' => 2,
        ]);
        \App\UserActionUserRole::create([
            'user_action_id' => 2,
            'user_role_id' => 1,
        ]);
        \App\UserActionUserRole::create([
            'user_action_id' => 2,
            'user_role_id' => 2,
        ]);
        \App\UserActionUserRole::create([
            'user_action_id' => 3,
            'user_role_id' => 2,
        ]);
        \App\UserActionUserRole::create([
            'user_action_id' => 4,
            'user_role_id' => 2,
        ]);
        \App\UserActionUserRole::create([
            'user_action_id' => 5,
            'user_role_id' => 2,
        ]);
    }
}
