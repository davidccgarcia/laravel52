<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminTest extends TestCase
{
    use DatabaseTransactions;

    public function test_admin_can_see_panel()
    {
        $admin = $this->createUser([
            'email' => 'admin@gmail.com'
        ]);
        
        $this->actingAs($admin)
            ->visit('/')
            ->click('Admin')
            ->seePageIs('admin/dashboard')
            ->see('Welcome to the admin panel');
    }

    public function test_another_users_cannot_see_panel()
    {
        $user = $this->createUser();

        $this->actingAs($user)
            ->visit('/')
            ->dontSee('Admin');
    }
}
