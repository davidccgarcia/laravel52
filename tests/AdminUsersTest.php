<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminUsersTest extends TestCase
{
    use DatabaseTransactions;


    public function test_list_users()
    {
        $user = $this->createUser([
            'first_name' => 'David', 
            'last_name' => 'García', 
            'email' => 'admin@gmail.com', 
            'password' => bcrypt('secret')
        ]);
        
        $this->dontSeeIsAuthenticated();

        $this->visit('/')
            ->see('Login')
            ->click('Login')
            ->type('admin@gmail.com', 'email')
            ->type('secret', 'password')
            ->press('Login');
        
        $this->seeIsAuthenticated();

        $this->actingAs($user)
            ->click('Users')
            ->seePageIs('admin/users')
            ->within('#content', function () use ($user) {
                $this->see($user->name)
                    ->see($user->email);
            });
    }
}
