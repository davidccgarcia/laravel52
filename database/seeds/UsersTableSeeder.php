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
        factory(App\User::class)->create([
            'first_name' => 'David', 
            'last_name' => 'García', 
            'email' => 'admin@gmail.com', 
            'password' => bcrypt('secret'),
        ]);

        factory(App\User::class, 3)->create();
    }
}
