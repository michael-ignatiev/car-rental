<?php

use Illuminate\Database\Seeder;

class UserActionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\UserAction::create([
            'name' => 'product.showAll',
        ]);
        \App\UserAction::create([
            'name' => 'product.showOne',
        ]);
        \App\UserAction::create([
            'name' => 'product.store',
        ]);
        \App\UserAction::create([
            'name' => 'product.update',
        ]);
        \App\UserAction::create([
            'name' => 'product.delete',
        ]);
        \App\UserAction::create([
            'name' => 'user.showAll',
        ]);
        \App\UserAction::create([
            'name' => 'user.showOne',
        ]);
        \App\UserAction::create([
            'name' => 'user.update',
        ]);
        \App\UserAction::create([
            'name' => 'branch.showAll',
        ]);
        \App\UserAction::create([
            'name' => 'branch.showOne',
        ]);
        \App\UserAction::create([
            'name' => 'branch.update',
        ]);
    }
}
