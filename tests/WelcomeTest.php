<?php


class WelcomeTest extends TestCase
{
    function test_welcome_user()
    {
        $this->visit('/')
            ->seeElement('img', ['src' => 'http://laravel52.activity/img/laravel_logo.png', 'alt' => 'Styde']);
    }
}
