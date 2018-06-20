<?php


class WelcomeTest extends TestCase
{
    function test_welcome_user()
    {
        $this->visit('/')
            ->see('Bienvenido a <b>Styde</b>');
    }
}
