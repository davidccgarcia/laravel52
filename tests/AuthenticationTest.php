<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

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

    function test_a_user_can_login()
    {
        $user = $this->createUser();

        $this->dontSeeIsAuthenticated();

        $this->visit('/')
            ->see('Login')
            ->click('Login')
            ->see('Login')
            ->type('admin@gmail.com', 'email')
            ->type('secret', 'password')
            ->press('Login');
        
        $this->seeIsAuthenticated();
        
        $this->seePageIs('/')
            ->see('Welcome - Laravel 5');
    }

    function test_a_user_can_logout()
    {
        $user = $this->createUser();

        $this->actingAs($user)
            ->seeIsAuthenticated()
            ->visit('/')
            ->see('Logout')
            ->click('Logout');

        $this->dontSeeIsAuthenticated();

        $this->seePageIs('/')
            ->see('Welcome - Laravel 5');
    }

    function test_an_admin_can_login_as_another_user()
    {
        $admin = $this->createUser();

        $anotherUser = factory(User::class)->create();

        $this->actingAs($admin)
            ->seeIsAuthenticatedAs($admin)
            ->visit('admin/login-as/' . $anotherUser->id)
            ->seePageIs('/')
            ->see($anotherUser->name)
            ->seeIsAuthenticatedAs($anotherUser);
    }

    public function createUser()
    {
        return factory(User::class)->create([
            'first_name' => 'David', 
            'last_name'  => 'García', 
            'email'      => 'admin@gmail.com', 
            'password'   => bcrypt('secret')
        ]);
    }
}
