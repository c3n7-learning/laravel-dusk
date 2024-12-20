<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class Login extends Page
{
    /**
     * Get the URL for the page.
     */
    public function url(): string
    {
        return '/login';
    }

    /**
     * Assert that the browser is on the page.
     */
    public function assert(Browser $browser): void
    {
        $browser->assertPathIs($this->url());
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array<string, string>
     */
    public function elements(): array
    {
        return [
            '@login-button' => 'button[type="submit"]',
        ];
    }

    public function fillInLoginForm(Browser $browser, string $email, string $password): void
    {
        $browser->assertSee('Email')
            ->type('email', $email)
            ->type('password', $password)
            ->click('@login-button')
            ->waitForText('logged in', 5);
    }
}
