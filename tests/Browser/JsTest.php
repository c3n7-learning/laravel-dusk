<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class JsTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_can_see_dad_jokes()
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('/')
                ->click('@dad-joke')
                // ->pause(2000)
                ->waitFor('#dadJokeContainer')
                ->assertVisible('#dadJokeContainer')
            ;
        });
    }

    public function test_can_right_click()
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('/')
                ->rightClick('@right-click')
                ->assertSee('Right clicked')
            ;
        });
    }

    public function test_can_double_click()
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('/')
                ->doubleClick('@double-click')
                ->assertSee('Double clicked')
            ;
        });
    }

    public function test_can_use_shortcut_keys()
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('/')
                ->keys('@multiple-keys', ['{control}', 'b'])
                ->assertSee('Ctrl + B pressed')
            ;
        });
    }
}
