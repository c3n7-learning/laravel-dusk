<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AuthTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_a_user_can_register_correctly()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->type('name', fake()->name())
                ->type('email', fake()->email())
                ->type('password', 'password')
                ->type('password_confirmation', 'password')
                ->click('button[type="submit"]')
                ->waitForText('logged in', 5)
                ->assertSee("logged in");
        });
    }

    public function test_a_user_can_login_correctly()
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create();

            $browser->visit('/')
                ->clickLink('Login')
                ->waitForText('Email', 5)
                ->type('email', $user->email)
                ->type('password', 'password')
                ->click('button[type="submit"]')
                ->waitForText('logged in', 5)
                ->assertSee("logged in");
        });
    }
}
