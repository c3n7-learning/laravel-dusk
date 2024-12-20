<?php

namespace Tests\Browser;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Components\NavbarLinks;
use Tests\Browser\Pages\Login;
use Tests\DuskTestCase;

class PagesTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_can_create_a_post()
    {
        $this->browse(function (Browser $browser) {

            $user = User::factory()->create();

            $browser->visit(new Login())
                ->fillInLoginForm($user->email, 'password')
                ->within(new NavbarLinks, function (Browser $browser) use ($user) {
                    $browser->doBasicNavigation($user->name);
                })
                ->visit(route('post.index'))
                ->clickLink('Create Post')
                ->waitForText('Create Post', 5)
                ->assertSee('Create Post')
                ->type('title', 'My first post')
                ->type('content', 'My first post content')
                // ->click('button[type="submit"]')
                ->click('@create-post')
                ->waitForText('Post was successfully created.', 5)
                ->assertSee('My first post')
                ->assertPathIs('/');
        });
    }


    public function test_can_edit_a_post()
    {
        $this->browse(function (Browser $browser) {

            $user = User::factory()->create();
            $post = Post::factory()->create();

            $browser->visit(new Login())
                ->fillInLoginForm($user->email, 'password')
                ->within(new NavbarLinks, function (Browser $browser) use ($user) {
                    $browser->doBasicNavigation($user->name);
                })
                ->visit(route('post.index'))
                ->clickLink($post->title)
                ->waitForText('EDIT POST', 5)
                ->clickLink($post->title)
                ->waitForText('Edit Post', 5)
                ->type('title', 'My first post')
                ->type('content', 'My first post content')
                ->click('@edit-post')
                ->waitForText('Post was successfully edited.', 5)
                ->assertSee('My first post')
                ->assertPathIs('/')
            ;
        });
    }
}
