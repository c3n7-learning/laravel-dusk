<?php

namespace Tests\Browser\Components;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Component as BaseComponent;

class NavbarLinks extends BaseComponent
{
    /**
     * Get the root selector for the component.
     */
    public function selector(): string
    {
        return '';
    }

    /**
     * Assert that the browser page contains the component.
     */
    public function assert(Browser $browser): void
    {
        $browser->assertVisible($this->selector());
    }

    /**
     * Get the element shortcuts for the component.
     *
     * @return array<string, string>
     */
    public function elements(): array
    {
        return [
            '@element' => '#selector',
        ];
    }

    public function doBasicNavigation(Browser $browser, string $name): void
    {
        $browser->assertSee($name)
            ->clickLink('Posts')
            ->waitForText('Posts', 5)
            ->clickLink('Dashboard')
            ->waitForText('logged in', 5)
        ;
    }
}
