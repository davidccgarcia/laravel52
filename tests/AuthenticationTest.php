<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthenticationTest extends TestCase
{
    use DatabaseTransactions;

    function test_user_can_register()
    {
        $this->visit('/')
            ->click('Register')
            ->see('Register')
            ->type('David', 'first_name')
            ->type('García', 'last_name')
            ->type('admin@gmail.com', 'email')
            ->type('Laravel', 'password')
            ->type('Laravel', 'password_confirmation')
            ->press('Register');

        $this->seeCredentials([
            'first_name' => 'David', 
            'last_name'  => 'García', 
            'email'      => 'admin@gmail.com', 
            'password'   => 'Laravel'
        ]);

        $this->see('login')
            ->see(trans('email.registration'));
    }
}
