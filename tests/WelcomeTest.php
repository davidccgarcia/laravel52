<?php


class WelcomeTest extends TestCase
{
    function test_welcome_user()
    {
        $this->visit('/')
            ->seeText('Bienvenido a Styde');
    }
}
